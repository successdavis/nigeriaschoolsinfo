@extends('layouts.app')
@section('title')
    List of Schools offering {{$course->name}} in Nigeria | NSIS
@endsection

@section('head')
    <meta name="description" content="The following is a list of schools offering <span>{{$course->name}} in Nigeria, arranged in alphabetical order">
  	<meta name="keywords" content="Schools offering {{$course->short_name}}"> 
@endsection
@section('content')

	{{-- ==== Google Adsense Display Ads ===== --}}
    @include ('sections/ads/horitalal_banner')
    
	<div class="container">
		<div class="columns mt-medium">
			<div class="column is-three-quarters">
				<div class="section">
					
					<div class="is-size-4 mb-small">The following is a list of schools offering <span>{{$course->name}} in Nigeria, arranged in alphabetical order</span></div>
					@foreach ($schools as $school)
						<div class="mb-small"><a href="{{$school->path()}}">{{$school->name}}</a></div>
					@endforeach
				</div>

			</div>
			<div class="column">
				
			</div>
		</div>
	</div>
@endsection