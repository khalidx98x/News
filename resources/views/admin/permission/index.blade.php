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
                    <li class="active">{{$page_title}}</li>
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
                    <strong class="card-title">{{$page_title}}</strong>
                   @canany(['create-permissions','all'])
                   <a href="{{route('permission.create')}}" class="btn btn-primary pull-right">Create</a>
                   @else
                   <a href="#" class="btn btn-primary pull-right disabled">Create</a>

                   @endcan

                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>

                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $index =>$permission)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$permission->name}}</td>
                    <td>
                      @canany(['update-permissions','all'])
                      <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-info">Edit</a>
                      @else
                      <a href="#" class="btn btn-info disabled" >Edit</a>
                      @endcan

                      @canany(['delete-permissions','all'])
                      <form action="{{route('permission.destroy',$permission->id)}}" method="post" style="display:inline"
                        onsubmit="return confirm('Are you sure you want to delete this permission?');">
                      @csrf()
                      @method('DELETE')
                  <button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  @else
                  <a href="#"  class="btn btn-danger disabled"><i class="fa fa-trash"></i></a>
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
