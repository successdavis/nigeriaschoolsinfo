@extends('layouts.app')

@section('title')
    {{$scholarship->title}}
@endsection

@section('head')
    <meta name="description" content="{{$scholarship->meta_description}}">
  	<meta name="keywords" content="apply for a scholarship, scholarship in nigeria, Nigeria scholarships"> 

  	<meta property="og:title" content="{{$scholarship->title}}" />
  	<meta property="og:url" content="{{ url($scholarship->path()) }}" />
  	{{-- <meta property="og:description" content="{{$scholarship->meta_description}}"> --}}
  	<meta property="og:type" content="article" />

	<meta name=”robots” content=”index, follow”>
  	<link rel="canonical" href="{{ url($scholarship->path()) }}" />

@endsection

@section('content')
	<div class="container">
	@include ('sections/ads/horizontal_banner')
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<div>
						<a class="button" href="/latest-scholarships-opportunities-for-application">View all Scholarships</a>
						<a class="button" href="/scholarships/create-a-new-scholarship">Create a new Scholarship</a>
						@can('update', $scholarship)
							<a class="button" href="/edit-scholarship/{{$scholarship->slug}}">Update Scholarship</a>
						@endcan
					</div>
					<div class="section">
						<h1 class="is-size-3">{{$scholarship->title}}</h1>
					</div>
					<div class="content">
						<p>{!! nl2br($scholarship->description) !!}</p>
					</div>

		        	<div class="section">
						<a class="button is-link is-outlined" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url($scholarship->path()) }}&display=popup">
						<img style="width: 20px; margin-right: .4em;" src="{{url('/images/facebook.svg')}}"> Share Post </a>

						<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="@NSISnews" data-hashtags="Nigeria News, Asu, WaecNigeria, jamb" data-related="NSISnews,S_techmax" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
					
					@include ('sections/ads/in-article')

				</div>				
			</div>
			<div class="column is-4">
				<h4>Sponsored Content</h4>
				@include ('sections/ads/v-banner')			
			</div>
		</div>
	</div>

@endsection