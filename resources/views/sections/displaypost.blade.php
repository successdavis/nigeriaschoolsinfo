<div class="container">
	<div class="mt-medium">
		<div class="columns">
			<div class="column is-three-quarters">
				<h2 class="is-size-3 has-text-centered mb-small">Latest Info</h2>
				<div style="padding: .2em 1em;">
				    <input class="input mb-medium" type="text" placeholder="Search through posts">
				</div>
				@foreach ($posts as $post)
					@include('sections/partials/_post')
				@endforeach
				
			</div>
			<div class="column">
				Hello world from the other side of the country 
			</div>
		</div>
	</div>
</div>