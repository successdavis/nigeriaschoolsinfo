@extends('layouts.app')

@section('title')
    {{$school->name}}
@endsection

@section('head')
    <meta name="description" content="All you need to know about {{$school->name}}, cut-of-point, courses offered, location and photos of {{$school->short_name}}">
  	<meta name="keywords" content="{{$school->name}} project"> 

  	<meta property="og:title" content="{{$school->name}}" />
  	<meta property="og:url" content="{{ url($school->path()) }}" />
  	<meta property="og:description" content="{{$school->meta_description}}">
  	<meta property="og:image" content="{{asset($school->logo_path)}}">
  	<meta property="og:type" content="article" />
  	<link rel="canonical" href="{{ url($school->path()) }}" />
	<meta name=”robots” content=”index, follow”>
  	
@endsection


@section('content')
    @include ('sections/ads/horizontal_banner')

<div class="container">
	<div class="columns is-gapless">
		<div class="column is-three-quarters">
			@auth
				@can('update schools')
					<a href="/schools/{{$school->slug}}/edit" class="button">Edit School</a>
				@endcan
			@endauth
			<div class="">
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
					<div class="is-size-4">{{$school->short_name}} Admission Info: </div>
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
					<div class="is-size-4 ">Description</div>
					<p class="content has-text-justified">{!! nl2br($school->description) !!}</p>

					<div class="section content">
						<h3>Recommended Articles</h3>
						@foreach ($school->posts as $followup)
							<a class=" is-size-5" href="{{$followup->path()}}">{{$followup->title}} Click to Read</a><br>
						@endforeach
					</div>
				    
				    <h3 class="is-size-4">{{ucfirst($school->short_name)}} cut off mark</h3>
				    <p class="content has-text-justified">The average cut off mark for {{$school->short_name}} is {{$school->jamb_points}}. It is important to note that this cut off mark may not be applicable for all courses, some courses may require you to score higher, while some even lower. <br>
				    
				    @include ('sections/ads/in-feed')

				    To view a complete list of courses and their required cut off mark for {{$school->short_name}}. <a href="/courses-offered-in/{{$school->slug}}">Click here</a>
				    </p>

					<div class="is-size-4 mt-small">{{$school->short_name}} School Address?</div>
					<div class="content has-text-justified">{{$school->name }} is located in {{$school->state->name}} State, {{$school->lga->name}} Local Government Area.</div>
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
					<h4 class="is-size-4">{{$school->name}} courses and departments:</h4>
					<div class="is-size-5-desktop mb-small">The following is a list of courses offered in {{$school->short_name}} </div>
					
					<table class="table">
						<thead>
							<tr>
								<th><abbr title="School">Courses</abbr></th>
								<th><abbr title="School">Cut-of-points</abbr></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($school->courses as $course)
								<tr>
									<td><a href="{{$course->path()}}">{{$course->name}}</a></td>
									<td>{{$course->pivot->cut_off_points}}</td>
								</tr>	
							@endforeach
						</tbody>
					</table>

					<a class="button is-large is-success" href="/courses-offered-in/{{$school->slug}}">View All Courses</a>
				</div>
				<h4 class="is-size-4 mt-large">Photos of {{$school->name}}</h4>
				<div class="section">
					<image-carousel :wraparound="true" :autoplay="true" >
				        @foreach ($school->photos as $photo)
				            <div class="card" style="width: 260px; margin: 0 10px">
							  <div class="card-image">
							    <figure class="image" >
							      <img src="{{$photo->url}}" alt="{{$photo->caption}}">
							    </figure>
							  </div>
							  <div class="card-content">
							  	<h3 class="is-size-4">{{$photo->caption}}</h3>
							  	<p>{{$photo->description}}</p>
							  </div>
							</div>
				        @endforeach     
				    </image-carousel>
				</div>

				<div class="section">
					<a class="button is-link is-outlined" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url($school->path()) }}&display=popup">
					<img style="width: 20px; margin-right: .4em;" src="{{url('/images/facebook.svg')}}"> Share Post </a>

					<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="@NSISnews" data-hashtags="Nigeria News, Asu, WaecNigeria, jamb" data-related="NSISnews,S_techmax" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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