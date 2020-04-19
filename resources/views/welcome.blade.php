@extends('layouts.app')

@section('title')
    NSIS - News Update, Projects Materials, Research Papers etc
@endsection

@section('head')
    <meta name="description" content="Nigeria School Information System, we provide you with latest news on Nigeria Education Systems, Project Materials, Research Papers etc.">
  	<meta name="keywords" content="Education News Update, Project Topics, Education projects"> 
@endsection

@section('content')
	@include ('sections/streamer')

	<div class="section has-text-centered">
		<h3 class="is-size-3">Welcome to Nigeria School Information System</h3>
		<p class="is-size-4">"be right at home <i class="fas fa-mug-hot"></i>"</p>
	</div>
	<div class="container">
		<div class="mb-large">
			<div class="columns">
				<div class="column is-6">
					<div class="section">
						<h1 class="is-size-3">Latest Education News</h1>
					</div>
					@foreach ($posts as $post)
						<article class="media">
							<div class="media-content">
								<h3><a class="has-text-black" href="{{$post->path()}}">{{$post->title}}<strong>Click to Read</strong></a></h3>
							</div>
						</article>
					@endforeach
				</div>
				<div class="column is-6 ">
					<h2 class="is-size-3">Top Selling Projects</h2>
				</div>
			</div>
		</div>
	</div>
@endsection
