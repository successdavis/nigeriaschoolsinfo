@extends('layouts.app')

@section('title')
    {{$exams->name}}
@endsection

@section('head')
    <meta name="description" content="All you need to know about {{$exams->name}}, cut-of-point, courses offered, location and photos of {{$exams->short_name}}">
  	<meta name="keywords" content="{{$exams->name}} project"> 

  	<meta property="og:title" content="{{$exams->name}}" />
  	<meta property="og:url" content="{{ url($exams->path()) }}" />
  	<meta property="og:description" content="{{$exams->meta_description}}">
  	<meta property="og:image" content="{{asset($exams->logo_path)}}">
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="{{ url($exams->path()) }}" />
	<meta name=”robots” content=”index, follow”>
  	
@endsection


@section('content')


	{{-- ==== Google Adsense Display Ads ===== --}}
	@include ('sections/ads/horizontal_banner')

	<h1>{{$exams->name}}</h1>

	<div>
		<tabs>
			<tab name="Overview" selected="true">
				<p>{{$exams->description}}</p>
			</tab>

			<tab name="News">
				<div class="content">
					<ul>
						@foreach($exams->getRecent() as $post)
							<li><a href="{{$post->path()}}">{{$post->title}}</a></li>
						@endforeach
					</ul>
				</div>

			</tab>
			<tab name="Articles">
				@foreach ($exams->posts as $followup)
					<p>
						<a class=" is-size-4" href="{{$followup->path()}}">{{$followup->title}}</a>
					</p>
				@endforeach
			</tab>
		</tabs>
	</div>

@endsection