<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    public function index(Request $request){
        $title                      = 'List Project';
        $keyword                    = $request->keyword;
        $project                    = Project::where('project_name','LIKE','%'.$keyword.'%')->orWhere('client','LIKE','%'.$keyword.'%')->orWhere('created_at','LIKE','%'.$keyword.'%')->orderBy('id','ASC')->paginate(4);
        return view('project.list',compact(['project','title']));
    }
    public function create()
    {
        $data['title']              = 'Add Project';
        
        return view('project.add')->with($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'projectname'          => 'required|max:255',
            'client'                => 'required|max:255',
            'projectleader'         => 'required|max:255',
            'email'                 => 'required|email|max:255',
            'startdate'             => 'required',
            'enddate'               => 'required',
            'progress'              => 'required',
            'file'                  => 'required|max:2048|mimes:jpg,png'
        ]);
        if($request->hasFile('file')){
            $filename               = time().'-' . Str::slug($request->projectname) . '.' . $request->file('file')->getClientOriginalExtension();
            $path                   = 'public/img';
            $request->file('file')->move($path, $filename);
            $data = [ 
                'project_name'      => $request->projectname,
                'client' 			=> $request->client,
                'project_leader'	=> $request->projectleader,
                'email'	    		=> $request->email,
                'start_date'	    => Project::tgl_sql($request->startdate),
                'end_date'	    	=> Project::tgl_sql($request->enddate),
                'progress'	    	=> $request->progress,
                'file'	    		=> $filename,
            ];
        }
        
        Project::create($data);
        return redirect('/')->with('SUCCESSMSG','Add data successfully');
    }
   
    public function edit($id)
    {
        $data['title'] 				= 'Edit Project';

        $query 	                    = Project::where('id',$id)->get();
        
        if($query->count() > 0){
            
            foreach($query as $db){
                $data['id']             = $id;
                $data['projectname']	= $db->project_name;
                $data['client']		    = $db->client;
                $data['projectleader']  = $db->project_leader;
                $data['email']          = $db->email;
                $data['startdate']      = Project::tgl_indo($db->start_date);
                $data['enddate']        = Project::tgl_indo($db->end_date);
                $data['progress']       = $db->progress;
                $data['oldfile']        = $db->file;
                
            }
        }
        else{
            $data['id']                 = $id;
            $data['projectname']        = '';
            $data['client']		        = '';
            $data['projectleader']      = '';
            $data['email']              = '';
            $data['startdate']          = '';
            $data['enddate']            = '';
            $data['progress']           = '';
            $data['oldfile']            = '';
            
        }
        return view('project.edit')->with($data);
    }

   
    public function update(Request $request)
    {
        $id                         = $request->id;
        $validated = $request->validate([
            'projectname'           => 'required|max:255',
            'client'                => 'required|max:255',
            'projectleader'         => 'required|max:255',
            'email'                 => 'required|email|max:255',
            'startdate'             => 'required',
            'enddate'               => 'required',
            'progress'              => 'required',
            'file'                  => 'max:2048|mimes:jpg,png'
        ]);

        $file                       = $request->file('file');
        $oldfile	                = $request->oldfile;
        if ($file) {
            $filename               = time().'-' . Str::slug($request->projectname) . '.' . $file->getClientOriginalExtension();
            $path                   = 'public/img';
            $file->move($path, $filename);
            $data = [
                'project_name'      => $request->projectname,
                'client' 			=> $request->client,
                'project_leader'	=> $request->projectleader,
                'email'	    		=> $request->email,
                'start_date'	    => Project::tgl_sql($request->startdate),
                'end_date'	    	=> Project::tgl_sql($request->enddate),
                'progress'	    	=> $request->progress,
                'file'	    		=> $filename,
            ];
            File::delete($path.'/'.$oldfile);
        }
        else{
            $data = [
                'project_name'      => $request->projectname,
                'client' 			=> $request->client,
                'project_leader'	=> $request->projectleader,
                'email'	    		=> $request->email,
                'start_date'	    => Project::tgl_sql($request->startdate),
                'end_date'	    	=> Project::tgl_sql($request->enddate),
                'progress'	    	=> $request->progress,
                'file'	    		=> $oldfile,
            ];
            $id						= $request->id;
            $d						= Project::where('id','=',$id);
        }
       
        Project::where('id',$id)->update($data);
        return redirect('/')->with('SUCCESSMSG','Updated Data Successfully');
    }

    public function destroy(Request $request)
    {
        $id                         = $request->id;
        $storage                    = Project::find($id);
        if($storage){
            File::delete('public/img/'.$storage->file.'');
            $storage->delete();
        }else{
            return redirect('/')->with('GAGALMSG','Delete Data Failed');
        }
    }

}
