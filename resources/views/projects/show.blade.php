@extends('layouts.app')

@section('title')
    {{$project->title}}
@endsection

@section('head')
    <meta name="description" content="{{$project->course->name}} project. {{$project->title}} . {{$project->excerpt()}}">
  	<meta name="keywords" content="{{$project->course->name}} project"> 
@endsection

@section('content')
	<div class="container">
		@include('/projects/partials/purchase_btn')
			
		<div class="columns">
			<div class="column is-9">
				<div class="section">
					<h1 class="is-size-2">{{$project->title}}</h1>
				</div>
				<p class="section">{!! nl2br($project->description) !!}</p>
			    
			    @include ('sections/ads/in-article')

				@includ('/projects/partials/purchase_btn')

			</div>
			<div class="column is-3">

				{{-- show the project Edit Button if you are an admin --}}
				@auth()
					@if (auth()->user()->isAdmin())
				        <a class="button" href="{{ route('project.edit',['project' => $project->slug]) }}">Edit</a>
				    @endif
				@endauth


				<div class="section">
					<h3 class="is-size-3">Similar Projects</h3>
				</div>
				<article class="media">
					@foreach ($relatedProjects as $project)
						<div class="media-content">
							<a href="{{$project->path()}}" class="has-text-black">{{$project->title}}</a>
						</div>
					@endforeach
				</article>

			</div>
		</div>
	</div>
	
	
@endsection

@section('footer')
	<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection