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
	@include ('sections/ads/horizontal_banner')
		<div class="columns">
			<div class="column is-8">
				<div class="section">
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
				</div>				
			</div>
			<div class="column is-4">
				<h4>Sponsored Content</h4>
				@include ('sections/ads/v-banner')
			</div>
		</div>
	</div>

@endsection