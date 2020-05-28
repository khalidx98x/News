
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
                    <strong class="card-title">{{$page_name}}</strong>
                   @canany(['create-post','all'])
                    <a href="{{route('post.create')}}" class="btn btn-primary pull-right">Create</a>
                    @else
                    <a class="btn btn-primary pull-right disabled">Create</a>
                    @endcan
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Total View</th>
                <th>Status</th>
                <th>Hot News</th>
                <th>Category</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $index =>$post)
                <tr>
                    <td >{{++$index}}</td>
                    <td style="width: 10%">
                        @if(file_exists(public_path('uploads/post/').$post->thumb_image))
                        <img src="{{ asset('uploads/post').'/'.$post->thumb_image }}" class="img img-responsive">
                        @endif
                    </td>
                    <td >{{$post->title}}</td>
                    <td >{{$post->user->name}}</td>
                    <td >{{$post->view_count}}</td>
                    <td >
                        @canany(['status-post','all'])
                     @if ($post->status==1)

                        <a href="{{route('post.status',$post->id)}}" class="btn btn-danger">Un Publish</a>
                        @else
                        <a href="{{route('post.status',$post->id)}}" class="btn btn-success">Publish</a>
                        @endif
                        @endcan
                    </td>

                    <td>
                     @if ($post->hot_news==1)

                        <a href="{{route('post.hot',$post->id)}}" class="btn btn-danger">Yes</a>
                        @else
                        <a href="{{route('post.hot',$post->id)}}" class="btn btn-success">No</a>
                        @endif
                    </td>
                    <td>{{$post->category->name}}</td>

                    <td>
                        @canany(['view-comment','all'])
                        <a href="{{route('comment.index',$post->id)}}" class="btn btn-secondary">Comments</a>
                        @endcan

                        @canany(['update-post','all'])
                        <a href="{{route('post.edit',$post->id)}}" class="btn btn-info">Edit</a>
                        @endcan
                      @canany(['delete-post','all'])
                        <form action="{{route('post.destroy',$post->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf()
                            @method('DELETE')
                        <button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>

                        @endcan
                    </td>
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

