@extends('layouts.app')

@section('title')
    {{$category->title}} - Latest News
@endsection

@section('head')
    <meta name="description" content="{{$category->title}} - Latest News. Here at Nigeria School Information System, we provide you with up-to-date news update on {{$category->title}}">
  	<meta name="keywords" content="Scholarships, Education Scholarships"> 
@endsection

@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-8">
				<div class="section">
					<h1 class="is-size-4">{{$category->title}} - Latest News. Here at Nigeria School Information System, we provide you with up-to-date news update on {{$category->title}}</h1>
				</div>
				<div>
					@foreach ($posts as $post)
						<article class="media">
							<div class="media-content">
								<h3 class="is-size-4">
									<a class="has-text-black" href="{{$post->path()}}">{{$post->title}}</a>
								</h3>
								<p>{!! nl2br($post->excerpt()) !!}</p>
							<div>
							
							</div>
							</div>
						</article>
					@endforeach
				</div>
				<div class="section">
					{{ $posts->links() }}
				</div>
			</div>
			<div class="column is-4">
				<h4>Sponsored Content</h4>
			</div>
		</div>
	</div>

@endsection