@extends('layouts.app')

@section('content')
<div class="container">
	
	<div class="section">
		<div class="tile is-ancestor wrap-elements">
	      	@foreach ($exams as $exam)
				@include('exams.partials.examCard')
			@endforeach
		</div>
	</div>
</div>
@endsection