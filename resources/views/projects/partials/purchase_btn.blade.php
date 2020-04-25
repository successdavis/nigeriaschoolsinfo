<div class="section">
	@auth()
		@if ($project->downloadsAccessLeft() >=1)
			<a class="button" href="/download/{{$project->slug}}/file">Download ({{$project->downloadsAccessLeft()}})</a>
		@else
		<paystack-payment email="{{auth()->user()->email}}" description="Project Purchasing" type="Project" id="{{$project->id}}"></paystack-payment>
		@endif
	@else
		<a href="/login" class="button">Purchase</a>
	@endauth
</div>