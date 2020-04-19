@extends('layouts.app')

@section('title')
    {{$job->title}}
@endsection

@section('head')
    <meta name="description" content="{{$job->meta_description}}">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection

@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<h1 class="is-size-3">{{$job->title}}</h1>
				</div>
				<div>
					<p>{{$job->description}}</p>
				</div>
			</div>
			<div class="column is-4">
				<h4>Sponsored Content</h4>
			</div>
		</div>
	</div>

@endsection