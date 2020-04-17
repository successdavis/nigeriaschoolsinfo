@extends('layouts.app')

@section('title')
    {{$project->title}}
@endsection

@section('head')
    <meta name="description" content="{{$project->category->title}} project. {{$project->title}} . {{$project->excerpt()}}">
  	<meta name="keywords" content="{{$project->category->title}} project"> 
@endsection

@section('content')
	<h1>{{$project->title}}</h1>
	<p>{{$project->description}}</p>
@endsection