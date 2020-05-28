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
                   @canany(['create-category','all'])
                    <a href="{{route('category.create')}}" class="btn btn-primary pull-right">Create</a>
                    @else
                    <a class="btn btn-primary pull-right disabled">Create</a>
                    @endcan
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index =>$category)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        @canany(['status-category','all'])
                     @if ($category->status==1)

                        <a href="{{route('category.status',$category->id)}}" class="btn btn-danger">Un Publish</a>
                        @else
                        <a href="{{route('category.status',$category->id)}}" class="btn btn-success">Publish</a>
                        @endif
                        @endcan
                    </td>
                    <td>
                        @canany(['update-category','all'])
                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-info">Edit</a>
                        @endcan
                      @canany(['delete-category','all'])
                        <form action="{{route('category.destroy',$category->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this category?');">
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
