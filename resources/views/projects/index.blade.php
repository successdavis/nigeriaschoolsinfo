<?php
	$selected = $course ?? '';
?>
@extends('layouts.app')

@section('title')
    List of Nigeria Education Project Topic and Materials
@endsection

@section('head')
    <meta name="description" content="Download up-to-date Nigeria education projects, topics and materials here on PDF format. NCE, Degree, Masters, Doctorate Project Materials">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection

@section('content')
{{-- ==========Display Google Ads ====== --}}
@include ('sections/ads/horitalal_banner')

<div class="section">
	<div class="columns">
		<div class="column is-3 is-hidden-mobile">
			<div class="section">
				<h3 class="is-size-4">Browse by Courses</h3>
			</div>
				@foreach ($courses as $course)
					<div>
						<a 
							href="{{$course->categoryPath()}}" 
							class="has-text-black">{{$course->name}}
						</a>
						({{$course->projects_count}})
					</div>
				@endforeach
		</div>
		<div class="column is-3 is-hidden-tablet">
			<form>
				<div class="field">
					<div class="control">
						<div class="select is-primary">
							<select onchange="location = this.options[this.selectedIndex].value;">
								<option selected="" value="/projects">All Projects</option>
								@foreach ($courses as $course)
									<option
										<?php if($selected->slug == $course->slug) echo "selected" ?>
									 value="{{$course->path()}}">{{$course->name}}</option>
									</div>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="column is-6">
			<div class="section">
				<h1 class="is-size-3">Latest Nigeria Education Projects Topic and Materials</h1>
			</div>
			@foreach ($projects as $project)
				<article class="media">
					<div class="media-content">
						<div class="columns">
							<div class="column is-10">
								<h3 class="is-size-5"><strong>
									<a href="{{$project->path()}}" 
										class="has-text-black" href="">{{$project->title}}
									</a></strong>
								</h3>
							</div>
							<div class="column is-2">
								{{$project->SchoolType->name}}
							</div>
						</div>
						<a href="{{$project->path()}}" class="has-text-black">
							<p>{{$project->description}}</p>
						</a>
					</div>
				</article>
			@endforeach
			<div class="section">
				{{ $projects->links() }}
			</div>
		</div>
		<div class="column is-3">
			<div class="section">
				<h3 class="is-size-4">Sponsored Content</h3>
			</div>
		</div>
	</div>
</div>


	
@endsection