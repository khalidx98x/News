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
                      <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf()
                          <div class="form-group">
                              <label for="title" class="control-label mb-1">Title</label>
                              <input id="title" name="title" type="text" class="form-control" >
                          </div>

                          <div class="form-group">
                              <label for="category_id" class="control-label mb-1">Category </label>
                              <select name="category_id" id="category_id" class="form-control myselect">
                                  @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="short_description" class="control-label mb-1">Short Description</label>
                              <textarea name="short_description" id="short_description" class="form-control"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="description" class="control-label mb-1">Description</label>
                            <textarea name="description" id="description" class="form-control my-editor"></textarea>
                        </div>



                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Image</label>

                            <input type="file" name="image" class="form-control">
                        </div>

                              <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                  <i class="fa fa-lock fa-lg"></i>&nbsp;
                                  <span id="payment-button-amount">Create</span>
                                  <span id="payment-button-sending" style="display:none;">Creating...</span>
                              </button>
                          </div>
                      </form>
                  </div>
              </div>

            </div>
        </div>
    </div>
@endsection
