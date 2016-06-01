@extends('layout')	

@section('content')
<div class="row">

	<div class="col-md-4">
		<h1>{{ $flyer->street }}</h1>
		<h2>{!! $flyer->price !!}</h2>
		<hr>
		<div class="description">
			{!! nl2br($flyer->description) !!}
		</div>
	</div>
	
	<div class="col-md-8 gallery">
		@foreach ($flyer->photos->chunk(3) as $set)
		<div class="row">
			@foreach ($set as $photo)
				<div class="col-md-4 gallery_image">
					<img src="/{{ $photo->thumbnail_path }}" alt="">
				</div>
			@endforeach
		</div>
		@endforeach
	</div>
</div>

<hr>

<h2>Add your photos</h2>
<form id="addPhotosForm" action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" method="POST" class="dropzone">
	{{ csrf_field() }}
</form>

@stop

@section('scripts.footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<script>
	Dropzone.options.addPhotosForm = {
		paramName: 'photo',
		maxFilesize: 3,
		acceptedFiles: '.jpg, .jpeg, .png, .bmp'
	};
</script>
@stop