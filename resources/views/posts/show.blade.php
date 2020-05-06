@extends('layouts.app')

@section('title')
    {{$post->title}} | NSIS News
@endsection

@section('head')
    <meta name="description" content="
     {{$post->meta_description}}
     ">
@endsection

@section('content')
	@include ('sections/ads/horizontal_banner')
	<div class="mt-large">
		<div class="container">
			<div class="columns" style="margin-left: 0;">
				<div class="column is-three-quarters">
					<div class="tile is-ancestor">
						<div class="tile is-parent">
						    <article class="tile is-child box">
						      <p class="title">{{$post->title}}</p> 
						      @auth()
							    @if (auth()->user()->isAdmin())
							    	<a href="/editpost/{{$post->slug}}" class="button">Edit</a>
								    @if ($post->locked)
							     		<form action="{{ route('post.unlock', ['post' => $post->slug]) }}" method="POST">
									    	@csrf
									 		<input type="hidden" name="unlock" value="unlock">
								      		<button class="button">Unlock</button>
									    </form>
									@else
									    <form action="{{ route('post.lock', ['post' => $post->slug]) }}" method="POST">
									    	@csrf
									 		<input type="hidden" name="lock" value="lock">
								      		<button class="button">Lock</button>
									    </form>
								     @endif

							    @endif
							  @endauth
						      <p class="subtitle">{{$post->source->name}}</p>
						      <div class="content">
						      	<div class="has-text-center">
						      		@isset ($post->source->logo_path)
								      	<p class="image is-64x64">
								      		<img class="is-rounded" src="{{asset($post->source->logo_path)}}">
								    	</p>
						      		@endisset
						      	</div>
						        <p>
						        	@if ($post->hasFeaturedImage())
								      	<p class="image" style="display: flex; justify-content: center;">
								      		<img style="width: 320px" class="" src="{{asset('storage/'.$post->featured_image)}}">
								    	</p>
						      		@endif

								    @include ('sections/ads/in-article')


						        	{!! nl2br($post->body) !!}
						        </p>
						      </div>
						    </article>
						    
							@include ('sections/ads/horizontal_banner')

						</div>
					</div>
					<comments commentable_type="Post" :commentable_id="{{$post->id}}" :post="{{$post}}"></comments>
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