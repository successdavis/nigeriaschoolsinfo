@extends('layouts.app')

@section('title')
    Latest job opportunities in Nigeria
@endsection

@section('head')
    <meta name="description" content="Are you looking for a job?, or want to try another job?. Find latest and available jobs and recruitment opportunities in Nigeria, Army recruitment and more">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection

@section('content')
	@include ('sections/ads/horitalal_banner')
	<div class="container">
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<h1 class="is-size-3">Latest Job and Recruitment Opportunities in Nigeria</h1>
				</div>
				<div>
					@include ('sections/ads/in-feed')

					@foreach ($jobs as $job)
						<article class="media">
							<div class="media-content">
								<h3 class="is-size-4">
									<a class="has-text-black" href="{{$job->path()}}">{{$job->title}}</a>
								</h3>
								<p>{!! nl2br($job->excerpt()) !!}</p>
							<div>
								<strong>Offered by: </strong>{{$job->employer}}
							</div>
							</div>
						</article>
					@endforeach
				</div>
				<div class="section">
					{{ $jobs->links() }}
				</div>
			</div>
			<div class="column is-4">
				<a class="button" href="/create-a-new-job">Create a new Job</a>
				<h4>Sponsored Content</h4>
			</div>
		</div>
	</div>

@endsection