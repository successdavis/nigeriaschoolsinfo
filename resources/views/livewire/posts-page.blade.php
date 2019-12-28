<div>
	<div >
	    <h2 class="is-size-3 has-text-centered mb-small">Latest Info </h2>
		<div style="padding: .2em 1em;">
		    <input wire:model.live="search" class="input mb-medium" type="text" placeholder="Search through posts">
		</div>
		@foreach ($posts as $post)
			@include('sections/partials/_post')
		@endforeach
		
	</div>
</div>
