@extends('layouts.app')
@section('title')
    List of Schools offering {{$course->name}} in Nigeria | NSIS
@endsection

@section('head')
    <meta name="description" content="The following is a list of schools offering <span>{{$course->name}} in Nigeria, arranged in alphabetical order">
  	<meta name="keywords" content="Schools offering {{$course->short_name}}">

  	<meta property="og:title" content="{{$course->name}} Courses" />
  	<meta property="og:url" content="https://nigeriaschoolinfo.test/schools-offering/facilis-veritatis-atque-dicta-ut" />
  	<meta property="og:description" content="The following is a list of schools offering <span>{{$course->name}} in Nigeria, arranged in alphabetical order">
  	{{-- <meta property="og:image" content="{{asset($school->logo_path)}}"> --}}
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="https://nigeriaschoolinfo.test/schools-offering/facilis-veritatis-atque-dicta-ut" />
@endsection
@section('content')
    
	<div class="container">

	{{-- ==== Google Adsense Display Ads ===== --}}
    @include ('sections/ads/horizontal_banner')
    
		<div class="columns mt-medium">
			<div class="column is-three-quarters">
				<div class="section"> 
					
					<div class="is-size-4 mb-small">The following is a list of schools offering <span>{{$course->name}} in Nigeria, arranged in alphabetical order</span></div>

					<table class="table">
						<thead>
							<tr>
								<th><abbr title="School">Schools</abbr></th>
								<th><abbr title="Points">Cut-of-points</abbr></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($schools as $school)
								<tr>
									<td><a href="{{$school->path()}}">{{$school->name}}</a></td>
									<td>{{$school->pivot->cut_off_points}}</td>
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