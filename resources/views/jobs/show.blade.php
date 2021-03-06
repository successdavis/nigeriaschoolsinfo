@extends('layouts.app')

@section('title')
    {{$job->title}}
@endsection

@section('head')
    <meta name="description" content="{{$job->meta_description}}">
  	<meta name="keywords" content="Project Topics, Education projects">
  	<meta property="og:title" content="{{$job->title}}" />
  	<meta property="og:url" content="{{ url($job->path()) }}" />
  	<meta property="og:description" content="{{$job->meta_description}}">
  	<meta property="og:image" content="{{ asset('storage/'.$job->featured_image) }}">
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="{{ url($job->path()) }}" />
	<meta name=”robots” content=”index, follow”>
  	
@endsection

@section('content')
	<div class="container">
	@include ('sections/ads/horizontal_banner')
		<div class="columns">
			<div class="column is-8">
				<div class="section content">
					<div>
						<a class="button" href="/latest-job-opportunities-and-application">View all Avaiable Jobs</a>
						<a class="button" href="/create-a-new-job">Create a new Job</a>
						@can('update', $job)
							<a class="button" href="/edit-job/{{$job->slug}}">Update Job</a>
						@endcan
					</div>
					<div class="section">
						<h1 class="is-size-3">{{$job->title}}</h1>
					</div>
					<div>
						@include ('sections/ads/in-article')
						<p>{!! nl2br($job->description) !!}</p>
						
					<div class="section">
						<a class="button is-link is-outlined" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url($job->path()) }}&display=popup">
						<img style="width: 20px; margin-right: .4em;" src="{{url('/images/facebook.svg')}}"> Share Post </a>

						<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="@NSISnews" data-hashtags="Nigeria News, Asu, WaecNigeria, jamb" data-related="NSISnews,S_techmax" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
						@include ('sections/ads/horizontal_banner')
					</div>
					<div>
						<h3 class="is-size-3">Latest News on {{$job->title}}</h3>
						@foreach ($posts as $post)
							<article class="media">
								<div class="media-content">
									<h3 class="is-size-4">{{$post->title}}</h3>
									<div>{{ $post->excerpt() }}</div>
								</div>
							</article>
						@endforeach
					</div>
				</div>
				<comments commentable_type="Job" :commentable_id="{{$job->id}}" :post="{{$job}}"></comments>				
			</div>
			<div class="column is-4">
				<div class="section">
					<h4 class="is-size-3">Related Jobs</h4>
					@foreach ($relatedJobs as $job)
						<article class="media">
							<div class="media-content">
								<h3><strong>{{$job->title}}</strong></h3>
							</div>
						</article>
					@endforeach
					@include ('sections/ads/v-banner')
					
				</div>
			</div>
		</div>
	</div>

@endsection