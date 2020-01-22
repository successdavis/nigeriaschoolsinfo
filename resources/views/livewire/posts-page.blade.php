<div>
	<div >
	    <h2 class="is-size-3 has-text-centered mb-small">Latest Info </h2>
		<div style="padding: .2em 1em;">
		    <input wire:model.live="search" class="input mb-medium" type="text" placeholder="Search through posts">
		</div>
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
			@include('sections/partials/_post')
		@endforeach
	</div>
</div>
