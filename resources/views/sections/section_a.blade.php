<div class="container">
	<div class="mb-large">
		<div class="columns" style="max-width: unset">
			<div class="column is-4">
				<div class="has-text-centered">
					<h1 class="is-size-3">Latest Education News</h1>
				</div>
				<div >
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<ins class="adsbygoogle"
					     style="display:block"
					     data-ad-format="fluid"
					     data-ad-layout-key="-fq-1p+61-mh+dq"
					     data-ad-client="ca-pub-3146034280624513"
					     data-ad-slot="4383575674"></ins>
					<script>
					     (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
					@foreach ($posts as $post)
						<article class="media">
							@if($post->hasFeaturedImage())
								<figure class="media-left">
								    <p class="image is-64x64">
								      <img 
								      src="{{$post->featured_image}}" alt="{{$post->title}} cover"
								      srcset="
								      {{asset('storage/posts/' . $post->slug)}}-320px.webp 320w, 
								      {{asset('storage/posts/' . $post->slug)}}-64px.webp 64w
								      "
								      sizes="" 
								      >
								    </p>
								 </figure>
							@endif
							<div class="media-content">
								<h3><a class="has-text-black" href="{{$post->path()}}">{{$post->title}} <strong> Click to Read</strong></a></h3>
							</div>
						</article>
					@endforeach
				</div>
				<div class="has-text-centered">
					<a class="button" href="/latest-nigeria-education-news">More News</a>
				</div>
			</div>
			<div class="column is-4">
				<div class="has-text-centered">
					<p class="is-size-4"><strong>Schorlarship</strong></p>
				</div>
				<div class="section">
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<ins class="adsbygoogle"
					     style="display:block"
					     data-ad-format="fluid"
					     data-ad-layout-key="-fq-1p+61-mh+dq"
					     data-ad-client="ca-pub-3146034280624513"
					     data-ad-slot="4383575674"></ins>
					<script>
					     (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
					@foreach ($scholarships as $scholarship)
						<article class="media">
							<div class="media-content">
								<h3><a class="has-text-black" href="{{$scholarship->path()}}">{{$scholarship->title}}<strong> Click to Read</strong></a></h3>
							</div>
						</article>
					@endforeach
				</div>	
				<div class="has-text-centered section">
					<a class="button" class="has-text-black" href="/latest-scholarships-opportunities-for-application">See All Scholarships</a>
				</div>
			</div>
			<div class="column is-4 ">
				<div class="has-text-centered">
					<h2 class="is-size-3">Project Topics and Materials</h2>
				</div>
				<div class="section">
					@foreach ($projects as $project)
						<article class="media">
							<div class="media-content">
								<h3><a class="has-text-black" href="{{$project->path()}}">{{$project->title}}<strong>Click to Read</strong></a></h3>
							</div>
						</article>
					@endforeach
				</div>
				<div class="has-text-centered">
					<a class="button" href="/nigeria-education-project-topics-and-materials">View All Projects</a>
				</div>
			</div>
		</div>
	</div>
</div>