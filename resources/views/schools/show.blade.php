@extends('layouts.app')
@section('content')
<div class="container">
	<div class="columns">
		<div class="column is-three-quarters">
			<div class="section">
				<article class="media mb-small is-hidden-desktop">
					<figure class="media-left">
						<p class="image is-48x48">
						  <img src="{{asset($school->logo_path)}}">
						</p>
					</figure>
					<div class="media-content">
						<div class="content">
						  <p>
						    <strong class="mb-small">{{$school->name}}</strong> <small> {{$school->short_name}}</small>
						    <br>
						  </p>
						</div>
					</div>
				</article>
				<article class="media mb-small is-hidden-touch">
					<figure class="media-left">
						<p class="image is-96x96">
						  <img src="{{asset($school->logo_path)}}">
						</p>
					</figure>
					<div class="media-content">
						<div class="content">
						  <p>
						    <strong class="mb-small is-size-3">{{$school->name}}</strong> <small class="is-size-5"> <br> {{$school->short_name}} 
						    	@if ($school->date_created)
						    		Established: {{$school->date_created}} 
						    	@endif
						    </small>
						    <br>
						  </p>
						</div>
					</div>
				</article>
				<div class="mb-small">
					<div class="mb-small"><strong>School Type:</strong> {{$school->typeOf()}} </div>
					<div><strong>Sponsor:</strong> {{$school->sponsored->name}} </div>
				</div>
				<div class="mb-small">
					<div class="is-size-4">{{$school->short_name}} Admission Info: </div>
					@if ($school->isAdmitting())
						<div>{{$school->short_name}} is open for application to new intake</div>
						<div>Interested candidates can find below the website address and portal for application, if you have trouble applying, please find below the school contacts information in the contact section below or visit <a target="_blank" href="https://www.sleettech.com">www.sleettech.com</a> for documented steps and procedures to successfully complete your application.</div>
					@else
						<div>{{$school->short_name }} is not open for registration at the moment, Please check back later</div>
						{{-- put a subscription button here later --}}
					@endif
				</div>
				<div class="mb-small">
					<div class="is-size-4 ">Description</div>
					<p>{!! nl2br($school->description) !!}</p>
					<div class="is-size-4">Contact Information</div>
					<div>{{$school->name }} is school located in {{$school->state->name}} State, {{$school->lga->name}} Local Government Area.</div>
					<div class="mt-small"><strong>School Address:</strong> {{$school->address}}</div>
					<div><strong>Phone Number: </strong> +234{{$school->phone}} </div>
					<div><strong>Email: </strong> {{$school->email}} </div>
					<div><strong>Website:</strong><a href="https://{{$school->website}}" target="_blank"> {{$school->website}}</a></div>
					<div><strong>Portal: </strong><a href="https://{{$school->portal_website}}" target="_blank"> {{$school->portal_website}}</a></div> 
				{{-- <p>{!! nl2br(str_replace(" ", "&nbsp;", $school->description)) !!}</p> --}}
				</div>
				<div class="mt-small">
					<div class="is-size-4 ">{{$school->name}} list of courses offered:</div>
					@foreach ($school->courses as $course)
						<div>{{$course->name}}</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="column">
			<div class="mt-large mb-medium">{{$school->short_name}} News</div>
			<related-post :module="'Schools'" :module_id="{{$school->id}}"></related-post>
		</div>
		
	</div>
</div>

@endsection