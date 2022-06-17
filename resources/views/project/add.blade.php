@extends('layout.main')

@section('title')
<title> Add Project </title>
@endsection
@section('section')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-50">
            <h1 class="text-heading text-center">Add New Project</h1>
            <div class="jumbotron">
                <form action="{{ route('project.add') }}" method="post" enctype="multipart/form-data" id="formaddproject">
                    @csrf
                    <div class="form-group">
                        <label for="projectname">Project Name</label>
                        <input type="text" class="form-control @error('projectname') is-invalid @enderror" name="projectname" id="projectname" value="{{ old('projectname')}}" placeholder="Input Project Name">
                    </div>
                    @error('projectname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="client">Client</label>
                        <input type="text" class="form-control  @error('client') is-invalid @enderror" name="client" id="client" placeholder="Input Client Name" value="{{ old('client')}}">
                    </div>
                    @error('client')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="projectleader">Project Leader</label>
                            <input type="text" class="form-control @error('projectleader') is-invalid @enderror" name="projectleader" id="projectleader" placeholder="Input Project Leader" value="{{ old('projectleader')}}">
                            @error('projectleader')
                            <div class="alert alert-danger mt-10">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Project Leader</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Input email" value="{{ old('email')}}">
                            @error('email')
                            <div class="alert alert-danger mt-10">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="startdate">Start Date</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control datepicker @error('startdate') is-invalid @enderror" name="startdate" id="startdate" placeholder="Start Project">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt "></i></span>
                                </div>
                            </div>
                            @error('startdate')
                            <div class="alert alert-danger mt-10">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="enddate">End Date</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control datepicker @error('enddate') is-invalid @enderror" name="enddate" id="enddate" placeholder="End Project">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt "></i></span>
                                </div>
                            </div>
                            @error('enddate')
                            <div class="alert alert-danger mt-10">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="progress">Progress</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('progress') is-invalid @enderror" name="progress" id="progress" placeholder="Input Progress (%)" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    @error('progress')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="file">File Photo</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file" placeholder="Input Photo">
                    </div>
                    @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <a href="{{ url('/')}}" class="btn btn-danger"><i class="fa fa-undo "></i> Back</a>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stop

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stop

    @section('script')
    <script>
        $("#progress").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        });
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            toggleActive: true,
            todayBtn: "linked",
            changeMonth: true,
            changeYear: true
        });
    </script>
    @stop