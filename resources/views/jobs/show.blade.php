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
				<comments commentable_type="Job" :commentable_id="{{$job->id}}" :post="{{$post}}"></comments>				
			</div>
			<div class="column is-4">
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

@endsection