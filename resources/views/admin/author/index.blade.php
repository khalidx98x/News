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
                    <a href="{{route('author.create')}}" class="btn btn-primary pull-right">Create</a>
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($authors as $index =>$author)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$author->name}}</td>
                    <td>{{$author->email}}</td>
                    <td>
                        @if(count($author->roles()->get()) >0)
                        <ul style="margin-left: 20px">
                           @foreach ($author->roles()->get() as $role )
                            <li>{{$role->name}}</li>
                           @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('author.edit',$author->id)}}" class="btn btn-info">Edit</a>
                        <form action="{{route('author.destroy',$author->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this author?');">
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
