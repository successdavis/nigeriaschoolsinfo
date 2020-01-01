@extends('layouts.app');
@section('content');
	@foreach ($courses as $course)
		<h1>{{$course->name}}</h1>
	@endforeach
@endsection