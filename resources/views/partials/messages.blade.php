@if(count($errors->all()) > 0)
 <div class="alert alert-danger">

 		@foreach($errors->all() as $error)
 		 <li>{{ $error }}</li>
 		@endforeach

 </div>
@endif

@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif
