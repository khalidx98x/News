@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Create Permission Page</strong>
            </div>
            <div class="card-body">
              <!-- Credit Card -->
              <div id="pay-invoice">
                  <div class="card-body">

                     @include('partials.messages')
                      <hr>
                      <form action="{{route('permission.store')}}" method="post" novalidate="novalidate">
                        @csrf()
                          <div class="form-group">
                              <label for="name" class="control-label mb-1">Name</label>
                              <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                          </div>

                          <div>
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
</div>
@endsection
