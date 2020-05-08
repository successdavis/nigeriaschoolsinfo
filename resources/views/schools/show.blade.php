@extends('layouts.app')

@section('title')
    {{$school->name}}
@endsection

@section('head')
    <meta name="description" content="All you need to know about {{$school->name}}, cut-of-point, courses offered, location and photos of {{$school->short_name}}">
  	<meta name="keywords" content="{{$school->name}} project"> 
@endsection


@section('content')
    @include ('sections/ads/horizontal_banner')

<div class="container">
	<div class="columns">
		<div class="column is-three-quarters">
			@auth
				@if (auth()->user()->isAdmin())
					<a href="/schools/{{$school->slug}}/edit" class="button">Edit School</a>
				@endif
			@endauth
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
					<div class="mb-small is-size-5-desktop"><strong>School Type:</strong> {{$school->typeOf()}} </div>
					<div class="is-size-5-desktop"><strong>Sponsor:</strong> {{$school->sponsored->name}} </div>
				</div>
				<div class="mb-small">
					<div class="is-size-3">{{$school->short_name}} Admission Info: </div>
					@if ($school->isAdmitting())
						<div class="is-size-5-desktop">{{$school->short_name}} is open for application to new intake</div>
						<div class="is-size-5-desktop">Interested candidates can find below the website address and portal for application, if you have trouble applying, use the contact information provided here <a target="_blank" href="https://www.sleettech.com">www.sleettech.com</a> for documented steps and procedures to successfully complete your application.</div>
					@else
						<div class="is-size-5-desktop">{{$school->short_name }} is not open for registration at the moment, Please check back later</div>
						{{-- put a subscription button here later --}}
					@endif
				</div>
			    @include ('sections/ads/in-article')

				<div class="mb-small">
					<div class="is-size-3 ">Description</div>
					<p class="is-size-5-desktop">{!! nl2br($school->description) !!}</p>

					<div class="section content">
						<h3>Recommended Articles</h3>
						@foreach ($school->posts as $followup)
							<a class=" is-size-5" href="{{$followup->path()}}">{{$followup->title}} Click to Read</a><br>
						@endforeach
					</div>
				    
				    <h3 class="is-size-3">{{ucfirst($school->short_name)}} cut off mark</h3>
				    <p class="content is-size-5">The average cut off mark for {{$school->short_name}} is {{$school->jamb_points}}. It is important to note that this cut off mark may not be applicable for all courses, some courses may require you to score higher, while some even lower. <br>

				    To view a complete list of courses and their required cut off mark for {{$school->short_name}}. <a href="/courses-offered-in/{{$school->slug}}">Click here</a>
				    </p>


					<div class="is-size-3 mt-small">Where is {{$school->short_name}} located?</div>
					<div class="is-size-5-desktop">{{$school->name }} is located in {{$school->state->name}} State, {{$school->lga->name}} Local Government Area.</div>
					<div class="is-size-5-desktop">
						<div class="mt-small"><strong>School Address:</strong> {{$school->address}}</div>
						<div><strong>Phone Number: </strong> +234{{$school->phone}} </div>
						<div><strong>Email: </strong> {{$school->email}} </div>
						<div><strong>Website:</strong><a href="https://{{$school->website}}" target="_blank"> {{$school->website}}</a></div>
						<div><strong>Portal: </strong><a href="https://{{$school->portal_website}}" target="_blank"> {{$school->portal_website}}</a></div> 
					</div>
				{{-- <p>{!! nl2br(str_replace(" ", "&nbsp;", $school->description)) !!}</p> --}}
				</div>
				<div class="mt-small">
					<div class="is-size-3">{{$school->name}} courses and departments:</div>
					<div class="is-size-5-desktop mb-small">The following is a list of courses offered in {{$school->short_name}} </div>
					@foreach ($courses as $course)
						<div class="is-size-5-desktop">{{$course->name}}</div>
					@endforeach
					<a href="/courses-offered-in/{{$school->slug}}">View All</a>
				</div>
			</div>
		</div>
		<div class="column">
			<div class="mt-large mb-medium">{{$school->short_name}} News</div>
			<related-post :module="'Schools'" :module_id="{{$school->id}}"></related-post>
			@include ('sections/ads/v-banner')
		</div>
		
	</div>
</div>

@endsection