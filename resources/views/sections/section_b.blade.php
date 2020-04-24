<div class="container">
	<div class="columns">
		<div class="column is-8">
			<h4 class="is-size-3 has-text-centered">
				<a class="has-text-black" href="/jobs-opportunities-in-nigeria">Looking for a job? Try the list below</a>
			</h4>
			<div class="section">
				@foreach ($jobs as $job)
					<article class="media">
						<div class="media-content">
							<h3><a class="has-text-black" href="{{$job->path()}}">{{$job->title}}<strong> Click to Read</strong></a></h3>
						</div>
					</article>
				@endforeach
			</div>
			<div class="has-text-centered section">
				<a class="button" class="has-text-black" href="/create-a-new-job">See All Jobs and Recruitment</a>
			</div>
		</div>
		<div class="column is-4">
			
		</div>
	</div>
</div>