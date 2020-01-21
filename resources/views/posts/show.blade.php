@extends('layouts.app')
@section('content')
	@include ('sections/streamer')
	<div class="mt-large">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<div class="tile is-ancestor">
						<div class="tile is-parent">
						    <article class="tile is-child box">
						      <p class="title">{{$post->title}}</p>
						      <p class="subtitle">{{$post->source->name}}</p>
						      <div class="content">
						      	<div class="has-text-center">
							      	<p class="image is-64x64">
							      		<img class="is-rounded" src="{{asset($post->source->logo_path)}}">
							    	</p>
						      	</div>
						        <p>{!! nl2br($post->body) !!}</p>
						      </div>
						    </article>
						</div>
					</div>
				</div>
				<div class="column">
					<h4 class="is-size-4 mb-small">Related Posts</h4> 
					<div>
						@foreach ($relatedPosts as $relatedPost)
							<div class="mb-small">
								<a href="{{$relatedPost->path()}}">{{$relatedPost->title}}</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		
	</div>

@endsection