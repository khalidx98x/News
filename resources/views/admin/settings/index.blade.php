@extends('admin.layout.master')

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>

<script>


    jQuery(document).ready(function() {
        var route_prefix = "/filemanager";

        jQuery(".myselect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });


        $('textarea[name=description]').ckeditor({
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
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
                      <form action="{{route('settings.update')}}" method="post" enctype="multipart/form-data">
                        @csrf()
                        @method('patch')
                          <div class="form-group">
                              <label for="system_name" class="control-label mb-1">System Name</label>
                              <input id="system_name" name="system_name" type="text" class="form-control" value="{{$system_name}}">
                          </div>


                        <div class="form-group">
                            <label for="favicon" class="control-label mb-1">Favicon</label>

                            <input type="file" name="favicon" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="front_logo" class="control-label mb-1">Front Logo</label>

                            <input type="file" name="front_logo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="admin_logo" class="control-label mb-1">Back Logo</label>

                            <input type="file" name="admin_logo" class="form-control">
                        </div>

                              <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                  <i class="fa fa-lock fa-lg"></i>&nbsp;
                                  <span id="payment-button-amount">Update Settings</span>
                                  <span id="payment-button-sending" style="display:none;">Updating...</span>
                              </button>
                          </div>
                      </form>
                  </div>
              </div>

            </div>
        </div>
    </div>
@endsection
