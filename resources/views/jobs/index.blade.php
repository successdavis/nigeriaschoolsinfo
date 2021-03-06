@extends('layouts.app')

@section('title')
    Latest job opportunities in Nigeria
@endsection

@section('head')
    <meta name="description" content="Are you looking for a job?, or want to try another job?. Find latest and available jobs and recruitment opportunities in Nigeria, Army recruitment and more">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection

@section('content')
	<div class="container">
	@include ('sections/ads/horizontal_banner')
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<h1 class="is-size-3">Latest Job and Recruitment Opportunities in Nigeria</h1>
				</div>
				@include ('sections/ads/in-feed')
				
				<div class="section">
					@foreach ($jobs as $job)
						<article class="media">
							<a class="has-text-black" href="{{$job->path()}}">
								<div class="media-content">
									<h3 class="is-size-4">
										<h3 class="has-text-black title" >{{$job->name}}</h3>
									</h3>
									<p>{{ $job->excerpt() }}</p>
								<div>
									<strong class="Subtitle">Offered by: {{$job->employer}}</strong>
								</div>
								</div>
							</a>
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