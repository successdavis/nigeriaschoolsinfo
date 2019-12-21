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
						        <p>{{$post->body}}</p>
						      </div>
						    </article>
						</div>
					</div>
				</div>
				<div class="column">
					<h4 class="is-size-4">Related Posts</h4> 
				</div>
			</div>
		</div>
		
	</div>

@endsection