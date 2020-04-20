@extends('layouts.app')

@section('title')
    Latest Scholarship Opportunities
@endsection

@section('head')
    <meta name="description" content="How to get a Scholarship?, or Looking for a Scholarship? Find latest and available scholarships opportunities here, this is your opportunity, take it">
  	<meta name="keywords" content="Scholarships, Education Scholarships"> 
@endsection

@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<h1 class="is-size-4">Looking for a Scholarship? you have arrived. Find latest and available scholarships opportunities here, this is your opportunity, take it</h1>
				</div>
				<div>
					@foreach ($scholarships as $scholarship)
						<article class="media">
							<div class="media-content">
								<h3 class="is-size-4">
									<a class="has-text-black" href="{{$scholarship->path()}}">{{$scholarship->title}}</a>
								</h3>
								<p>{!! nl2br($scholarship->excerpt()) !!}</p>
							<div>
								<strong>Offered by: </strong>{{$scholarship->institution}}
							</div>
							</div>
						</article>
					@endforeach
				</div>
				<div class="section">
					{{ $scholarships->links() }}
				</div>
			</div>
			<div class="column is-4">
				<a class="button" href="create-a-new-job">Create a new Job</a>
				<h4>Sponsored Content</h4>
			</div>
		</div>
	</div>

@endsection