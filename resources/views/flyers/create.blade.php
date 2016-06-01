@extends('layout')	

@section('content')
<h1>
	Are you selling your house?
</h1>
<form action="{{ url('flyers') }}" method="POST" role="form" enctype="multipart/form-data">
	@include('flyers.forms.form')
</form>
@stop
