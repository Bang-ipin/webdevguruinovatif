@extends('layout.main')

@section('title')
	<title> Project Monitoring </title>
@endsection
@section('section')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-50">
            <div class="table-container mb-100">
                <h1 class="text-heading text-center">Project Monitoring</h1>
                <form method="GET" class="form-horizontal form-bordered form-label-stripped mb-10" action="{{ url('/')}}">
                    <div class="row">
                        <div class="col-md-3">
                        </div> 
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="keyword" name="keyword" placeholder="Keyword">
                        </div> 
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-lg btn-primary float-right"></i>Search</button>
                        </div>
                    </div> 
				</form>
                <table class="table">
                    <thead>
                        <tr role="row" class="heading bg-gray">
                            <th width="15%" class="text-center">
                                PROJECT NAME
                            </th>
                            <th width="10%" class="text-center">
                                    CLIENT
                            </th>
                            <th width="25%" class="text-center">
                                    PROJECT LEADER
                            </th>
                            <th width="10%" class="text-center">
                                    START DATE
                            </th>
                            <th width="10%" class="text-center">
                                    END DATE
                            </th>
                            <th width="20%" class="text-center">
                                    PROGRESS
                            </th>
                            <th width="10%" class="text-center">
                                    ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($project->count() > 0)
                        @foreach($project as $item)
                            <tr>
                                <td>
                                    {{ $item->project_name}}
                                </td>
                                <td>
                                    {{ $item->client}}
                                </td>
                                <td>
                                    <div class="images">
                                        <img src="{{ asset('public/img/'.$item->file)}}" class="img-circle d-block"/>
                                    </div>
                                    <div class="description">
                                        <h2 class="font-weight-bold d-block">{{ $item->project_leader}}</h2>
                                        <span class="text-muted font-weight-bold d-block">{{ $item->email}}</span> 
                                    </div>
                                </td>
                                <td>
                                    {{ App\Models\Project::converttanggal($item->start_date)}}
                                </td>
                                <td>
                                    {{ App\Models\Project::converttanggal($item->end_date)}}
                                </td>
                                <td>
                                    @if($progress = $item->progress == '100')
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="progress mt-10">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-4 text-left">
                                                {{$item->progress }}%
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="progress mt-10">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-4 text-left">
                                                {{$item->progress }}%
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete-data" data-id="{{ $item->id}}"><i class="fa fa-trash"></i></button>
                                    <a href="{{ url('edit/'.$item->id)}}" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    @else
                        <tr>
                            <td colspan="7" align="center">Data Not Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{ $project->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css" rel="stylesheet" >
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js" type="text/javascript"></script>
@stop

@section('script')
<script>
	$(".delete-data").click(function(){
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "You will be delete this item ?",
            type: "warning",
            confirmButtonText: "Yes, delete",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('/destroy') }}",
                    type: "POST",
                    data:{
						'id':id,
						'_method':'DELETE',
						'_token': '{{ csrf_token() }}'
					},
                    success: function(){
                        swal(
                            'Success',
                            'Destroy Data <b style="color:green;">Success</b> button!',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        swal({
                            title: 'Opps...',
                            text: 'Error',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your stay here :)',
                    'error'
                )
            }
        })
    });
	
</script>
@stop