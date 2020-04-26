@extends('layouts.app')

@section('title')
    {{$scholarship->title}}
@endsection

@section('head')
    <meta name="description" content="{{$scholarship->meta_description}}">
  	<meta name="keywords" content="apply for a scholarship,"> 
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