@extends('layout')	

@section('content')
<h1>
	Are you selling your house?
</h1>
<div class="row">
	
	<form class="col-md-6" action="{{ url('flyers') }}" method="POST" role="form" enctype="multipart/form-data">
		@include('flyers.forms.form')

		@include('partials.errors')
	</form>
</div>
@stop


