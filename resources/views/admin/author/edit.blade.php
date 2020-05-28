@extends('admin.layout.master')

@section('content')
<script>
    jQuery(document).ready(function() {
        jQuery(".myselect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });

</script>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Create {{$page_name}}</strong>
            </div>
            <div class="card-body">
              <div id="pay-invoice">
                  <div class="card-body">

                     @include('partials.messages')
                      <hr>
                      <form action="{{route('author.update',$author->id)}}" method="post">
                        @csrf()
                        @method('patch')
                          <div class="form-group">
                              <label for="name" class="control-label mb-1">Name</label>
                              <input id="name" name="name" type="text" class="form-control" value="{{$author->name}}">
                          </div>

                          <div class="form-group">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input id="email" name="email" type="text" class="form-control" value="{{$author->email}}">
                        </div>


                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Password</label>
                            <input id="password" name="password" type="password" class="form-control">
                        </div>



                          <div class="form-group">
                            <label class="control-lable mb-1">Roles</label>
                            <select name="roles[]"  data-placeholder="Select Roles"
                             class="form-control myselect" multiple>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{in_array($role->id,$selectedRoles) ?'selected':''}}>{{$role->name}}</option>
                            @endforeach

                            </select>
                                                </div>

                                <div>




                          <div>
                              <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                  <i class="fa fa-lock fa-lg"></i>&nbsp;
                                  <span id="payment-button-amount">Update</span>
                                  <span id="payment-button-sending" style="display:none;">Creating...</span>
                              </button>
                          </div>
                      </form>
                  </div>
              </div>

            </div>
        </div>
    </div>
</div>
@endsection
