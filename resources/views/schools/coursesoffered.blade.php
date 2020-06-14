@extends('layouts.app')
@section('title')
    List of Courses offered in {{$school->short_name}} | NSIS
@endsection

@section('head')
    <meta name="description" content="The following is a list of courses offered by {{$school->name}} in Nigeria, arranged in alphabetical order">
  	<meta name="keywords" content="Courses offered by {{$school->short_name}}"> 

  	<meta property="og:title" content="{{$school->name}} Courses" />
  	<meta property="og:url" content="https://nigeriaschoolinfo.test/courses-offered-in/deserunt-sit-aliquid-laudantium-porro" />
  	<meta property="og:description" content="The following is a list of courses offered in <span>{{$school->name}} ({{$school->short_name}}), arranged in alphabetical order with their required cut of points">
  	<meta property="og:image" content="{{asset($school->logo_path)}}">
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="https://nigeriaschoolinfo.test/courses-offered-in/deserunt-sit-aliquid-laudantium-porro" />
@endsection
@section('content')

	{{-- ==== Google Adsense Display Ads ===== --}}
    @include ('sections/ads/horizontal_banner')
    
	<div class="container">
		<div class="columns mt-medium">
			<div class="column is-three-quarters">
				<div class="section">
					
					<div class="is-size-4 mb-small has-text-centered">The following is a list of courses offered in <span>{{$school->name}} ({{$school->short_name}}), arranged in alphabetical order with their required cut of points</span></div>

					<table class="table">
						<thead>
							<tr>
								<th><abbr title="Courses">Courses</abbr></th>
								<th><abbr title="Points">Cut-of-points</abbr></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($school->courses as $course)
								<tr>
									<td><a href="{{$course->path()}}">{{$course->name}}</a></td>
									<td>{{$course->pivot->cut_off_points}}</td>
								</tr>	
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<div class="column">
				
			</div>
		</div>
	</div>
@endsection