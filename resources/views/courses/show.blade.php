@extends('layouts.app')
@section('content')
	<h1>{{$courses->name}}</h1>
	<p>{{$courses->description}}</p>
@endsection