@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="columns mt-medium">
			<div class="column is-three-quarters">
				<div class="section">
					
					<div class="is-size-4 mb-small">The following is a list of schools offering <span>{{$course->name}} arranged in alphabetical order</span></div>
					@foreach ($schools as $school)
						<div class="mb-small"><a href="{{$school->path()}}">{{$school->name}}</a></div>
					@endforeach
				</div>

			</div>
			<div class="column">
				
			</div>
		</div>
	</div>
@endsection