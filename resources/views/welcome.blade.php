@extends('layouts.app')

@section('title')
    NSIS - News Update, Projects Materials, Research Papers etc
@endsection

@section('head')
    <meta name="description" content="Nigeria School Information System, we provide you with latest news on Nigeria Education Systems, Project Materials, Research Papers etc.">
  	<meta name="keywords" content="Education News Update, Project Topics, Education projects"> 
@endsection

@section('content')
	@include ('sections/streamer')
	<div class="section has-text-centered">
		<h3 class="is-size-3">Welcome to Nigeria School Information System</h3>
		<p class="is-size-4">"be right at home <i class="fas fa-mug-hot"></i>"</p>
	</div>
	@include ('sections/section_a')
	@include ('sections/section_b')
	
@endsection
