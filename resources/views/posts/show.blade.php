@extends('layouts.app')

@section('title')
    {{$post->title}} | NSIS News
@endsection

@section('head')
    <meta name="description" content="
     {{$post->meta_description}}
     ">
	<link rel="canonical" href="{{ url($post->path()) }}" />
	<meta name=”robots” content=”index, follow”>

    <meta property="og:url"           content="{{ url($post->path()) }}"/>
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{$post->title}}" />
	<meta property="og:description"   content="{{$post->meta_description}}" />
	<meta property="og:image"         content="{{$post->featured_image}}" />
	<meta property="og:site_name" 	content="Nigeria School Info" />


@endsection

@section('content')
	@include ('sections/ads/horizontal_banner')
	<div class="mt-large">
		<div class="container">
			<div class="columns" style="margin-left: 0;">
				<div class="column is-three-quarters">
					<div class="tile ">
					    <article class="tile is-child ">
					      <p class="title">{{$post->title}}</p> 
					      @can('update', $post)
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

						  @endcan
					      <p class="subtitle">{{$post->source->name}}</p>
					      <div class="content">
					        <p>
					        	@if ($post->hasFeaturedImage())
							      	<p class="image" style="display: flex; justify-content: center;">
							      		<img style="width: 320px" class="" 
							      		src="{{$post->featured_image}}" 
							      		alt="{{$post->title}} cover"
							      		srcset="
							      			{{asset('storage/posts/' . $post->slug)}}-320px.webp 320w,
							      		" 
							      		>
							    	</p>
					      		@endif

							    @include ('sections/ads/in-article')


					        	{!! nl2br($post->body) !!}

					        	@include('/layouts/sharebtn')

					        </p>
					      </div>
					    </article>
					    
						@include ('sections/ads/horizontal_banner')

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