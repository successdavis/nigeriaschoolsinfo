@extends('layouts.app')

@section('content')
		<p>Hi! This page is still under construction, A better UI/Ux is coming</p>
	@foreach ($exams as $exam)
		<a href="{{$exam->path()}}">{{$exam->name}}</a> br
	@endforeach
@endsection