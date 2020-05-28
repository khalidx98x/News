@extends('admin.layout.master')

@section('css')
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/lib/datatable/dataTables.bootstrap.min.css">
@endsection

@section('content')




<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">{{$page_name}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    @include('partials.messages')

    <div class="animated fadeIn">
        <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{$page_name}} for {{count($comments) >0 ?$comments['0']->post->title :''}} Post</strong>
                 </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($comments as $index =>$comment)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$comment->name}}</td>
                    <td>{{$comment->comment}}</td>
                  @canany(['comment-approval','all'])
                    <td>

                   @if ($comment->status==1)

                        <a href="{{route('comment.status',$comment->id)}}" class="btn btn-danger">Un Publish</a>
                        @else
                        <a href="{{route('comment.status',$comment->id)}}" class="btn btn-success">Publish</a>
                        @endif
                 </td>
                 @endcan
                 @canany(['replay-comment','all'])

                    <td>
                        <a href="{{route('comment.replay',$comment->post->id)}}" class="btn btn-info">Replay</a>

                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
          </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<script src="{{asset('admin')}}/assets/js/lib/data-table/datatables.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/jszip.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lib/data-table/datatables-init.js"></script>


@endsection
