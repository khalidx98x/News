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
                    <a href="{{route('role.create')}}" class="btn btn-primary pull-right">Create</a>
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($roles as $index =>$role)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        @if(count($role->permissions()->get()) >0)
                        <ul style="margin-left: 20px">
                           @foreach ($role->permissions()->get() as $permission )
                            <li>{{$permission->name}}</li>
                           @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('role.edit',$role->id)}}" class="btn btn-info">Edit</a>
                        <form action="{{route('role.destroy',$role->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this role?');">
                            @csrf()
                            @method('DELETE')
                        <button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>

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
