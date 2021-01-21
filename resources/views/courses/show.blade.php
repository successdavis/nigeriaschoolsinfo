@extends('layouts.app')

@section('title')
    {{$courses->name}} | {{$courses->short_name}} | NSIS
@endsection

@section('head')
    <meta name="description" content="All you need to knw about {{$courses->name}} and guide to get admission into any university to study {{$courses->short_name}}">
  	<meta name="keywords" content="Nigeria Education Courses Offered"> 

  	<meta property="og:title" content="{{$courses->name}}" />
  	<meta property="og:url" content="{{ url($courses->path()) }}" />
  	{{-- <meta property="og:description" content="{{$courses->meta_description}}"> --}}
  	{{-- <meta property="og:image" content="{{ asset('storage/'.$courses->featured_image) }}"> --}}
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="{{ url($courses->path()) }}" />
	<meta name=”robots” content=”index, follow”>

@endsection

@section('content')
<div class="container">
    @include ('sections/ads/horizontal_banner')
	
	<div class="columns">
		<div class="column is-three-quarters">
			<div class="section content">
				
				<h1 class="is-size-4 mb-medium">Course Title: {{$courses->name}}</h1>

				<h2 class="is-size-4">Course Description</h2>
				<p class="is-size-5">{!! nl2br($courses->description) !!}</p>

				<h2 class="is-size-4">Subject Combination for JAMB</h2>
				<p>Here are the courses to combine when filling this course for JAMB UTME</p>
				@foreach ($courses->subjects as $subject)
					<div>{{$subject->name}}</div>
				@endforeach
				<div>{{$courses->utme_comment}}</div>
			    @include ('sections/ads/in-article')

				<h2 class="is-size-4">Course Cut-of-Point</h2>
				<p>The required cut-of-points for this course ({{$courses->name}}) depends on the school you are applying for, basically every school has a minimum cut of marks for accepting students in this area. Also, it is important to note that your O'level subject is a primary criteria for screening, continue reading to know the required subjects you must have on your O'Level result</p>

				<h2 class="is-size-4">{{$courses->name}} Requirement UTME</h2>
				<div class="mb-medium">{{$courses->utme_requirement}}</div>

				<h2 class="is-size-4">{{$courses->name}} Requirements Direct Entry</h2>
				<div class="mb-small">{{$courses->direct_requirement}}</div>
			    

				<h2 class="is-size-4 mt-medium">Schools offering {{$courses->name}}</h2>
				<table class="table">
					<thead>
						<tr>
							<th><abbr title="School">School</abbr></th>
							<th><abbr title="School">Cut-of-points</abbr></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($courses->schools as $school)
							<tr>
								<td><a href="{{$school->path()}}">{{$school->name}}</a></td>
								<td>{{$school->pivot->cut_off_points}}</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
				<div><a href="/schools-offering/{{$courses->slug}}">Click to View More Schools</a></div>
				@include ('sections/ads/horizontal_banner')


				<h2 class="is-size-4 mt-medium">{{$courses->short_name}} Special Consideration</h2>
				<details>{!! nl2br($courses->considerations) !!}</details>

				<div class="section">
					<a class="button is-link is-outlined" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url($courses->path()) }}&display=popup">
					<img style="width: 20px; margin-right: .4em;" src="{{url('/images/facebook.svg')}}"> Share Post </a>

					<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="@NSISnews" data-hashtags="Nigeria News, Asu, WaecNigeria, jamb" data-related="NSISnews,S_techmax" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>

			</div>
		</div>
		<div class="column">
			<div class="section">
				<h3 class="is-size-5">Sponsored</h3>
				
			</div>

		</div>
	</div>
</div>
@endsection