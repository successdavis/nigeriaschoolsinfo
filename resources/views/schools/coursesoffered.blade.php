@extends('layouts.app')
@section('title')
    List of Courses offered in {{$school->short_name}} | NSIS
@endsection

@section('head')
    <meta name="description" content="The following is a list of courses offered by {{$school->name}} in Nigeria, arranged in alphabetical order">
  	<meta name="keywords" content="Courses offered by {{$school->short_name}}"> 
@endsection
@section('content')

	{{-- ==== Google Adsense Display Ads ===== --}}
    @include ('sections/ads/horitalal_banner')
    
	<div class="container">
		<div class="columns mt-medium">
			<div class="column is-three-quarters">
				<div class="section">
					
					<div class="is-size-4 mb-small has-text-centered">The following is a list of courses offered in <span>{{$school->name}} ({{$school->short_name}}), arranged in alphabetical order</span></div>
					@foreach ($courses as $course)
						<div class="mb-small"><a href="{{$course->path()}}">{{$course->name}}</a></div>
					@endforeach
				</div>

			</div>
			<div class="column">
				
			</div>
		</div>
	</div>
@endsection