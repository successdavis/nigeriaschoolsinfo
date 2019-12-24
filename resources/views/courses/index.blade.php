@extends('layouts.app')
@section('content');
	@foreach ($courses as $course)
		<a href="">{{$course->name}}</a>
	@endforeach
	
@endsection