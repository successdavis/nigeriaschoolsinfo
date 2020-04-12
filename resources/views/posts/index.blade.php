@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="section">
			<div class="mb-medium">
				<h1 class="has-text-centered is-size-3">
					Latest Nigeria Education News Update on Universities, Polytechnic, Colleges etc
				</h1>
			</div>
			
			<div class="columns">
				<div class="column is-three-quarters">
					<div >
						<div class="mb-large">
							<form action="/latest-nigeria-education-news">
								@csrf
							    <div class="field is-grouped">
								  <p class="control is-expanded">
								    <input name="q" value="{{$q}}" class="input" type="text" placeholder="Find a repository">
								  </p>
								  <p class="control">
								  	<button type="submit" class="button is-info">
								  		Go
								  	</button>
								  </p>
								</div>
							</form>
						</div>

{{-- 						<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<ins class="adsbygoogle"
						     style="display:block"
						     data-ad-format="fluid"
						     data-ad-layout-key="-fq-1p+61-mh+dq"
						     data-ad-client="ca-pub-3146034280624513"
						     data-ad-slot="4383575674"></ins>
						<script>
						     (adsbygoogle = window.adsbygoogle || []).push({});
						</script> --}}

						@foreach ($posts as $post)
							@include('sections/partials/_post')
						@endforeach

						<div class="section">
							{{ $posts->links() }}
						</div>
					</div>
				</div>
				<div class="column is-size-4">
					<div class="mb-medium">Trending News</div>

					@foreach ($trending as $trend)
						<article class="media">
						  <div class="media-content">
						      <a href="{{$trend->path()}}" class="control has-text-black">
					              {{$trend->title}} <br>
					              <span class="is-size-7">posted: {{$trend->created_at->diffForHumans()}}</span>
						      </a>
						  </div>
						  <figure class="media-right" style="margin-top: 10px">
						    <p class="image is-32x32">
						      <img src="{{asset($trend->source->logo_path)}}">
						    </p>
						  </figure>
						</article>
					@endforeach	
				</div>
			</div>
		</div>
	</div>
@endsection