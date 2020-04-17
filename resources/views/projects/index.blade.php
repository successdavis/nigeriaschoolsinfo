@extends('layouts.app')

@section('title')
    List of Nigeria Education Project Topic and Materials
@endsection

@section('head')
    <meta name="description" content="Get up-to-date Nigeria education projects topics and materials here available for download. NCE, Degree, Masters, Doctorate Project Materials">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection

@section('content')
	@foreach ($projects as $project)
		<ul>
			<li>{{$project->title}}</li>
			<p>{{$project->description}}</p>
		</ul>
	@endforeach
@endsection