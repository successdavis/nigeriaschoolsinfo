@extends('layouts.app')
@section('content')
	{{-- @include('schools.schoolCard'); --}}
	@foreach ($schools as $school)
		<a href="{{$school->path()}}">{{$school->name}}</a> <br>
	@endforeach
@endsection