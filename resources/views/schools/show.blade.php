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
	<div style="width:100vw; overflow: hidden;" class="mb-2">
	    @include ('sections/ads/horizontal_banner')
	</div>

<div class="container is-max-desktop">	
	<article class="media mb-small is-hidden-desktop">
		<figure class="media-left">
			<p class="image is-48x48">
			  <img src="{{asset($school->logo_path)}}">
			</p>
		</figure>
		<div class="media-content">
			<div class="content">
			  <p>
			    <strong class="mb-small">{{ucfirst($school->name)}}</strong> <small> {{$school->short_name}}</small>
			    <br>
			  </p>
			</div>
		</div>
	</article>
	<article class="media mb-small is-hidden-touch">
		<figure class="media-left">
			<p class="image is-96x96">
			  <img src="{{asset($school->logo_path)}}" alt="{{$school->name}} logo">
			</p>
		</figure>
		<div class="media-content">
			<div class="content">
			  <p>
			    <strong class="mb-small is-size-3">{{$school->name}}</strong> <small class="is-size-5"> <br> {{$school->short_name}} 
			    </small>
			    <br>
			  </p>
			</div>
		</div>
	</article>
		<div class="mb-2 is-size-5-desktop"><strong>Programme:</strong> {{$school->typeOf()}} </div>
		<div class="mb-3 is-size-5-desktop"><strong>Sponsor:</strong> {{ucfirst($school->sponsored->name)}} </div>

	<tabs>
		<tab name="News" selected="true">

			<div class="mb-small">
				<div class="is-size-4">{{ucfirst($school->short_name)}} Admission Info: </div>
				@if ($school->isAdmitting())
					<div class="is-size-5-desktop">{{$school->short_name}} is open for application to new intake</div>
					<div class="is-size-5-desktop">Interested candidates can find below the website address and portal for application, if you have trouble applying, do not hesitate to let us know using the comment section provided below or the institution's contact information provided here. Also check the recommended section below to find an article on the steps and procedures to successfully complete your application.</div>
				@else
					<div class="is-size-5-desktop">{{$school->short_name }} is not open for POST UTME or Direct Entry application at the moment, Please check back here again</div>
					{{-- put a subscription button here later --}}
				@endif
			</div>

			<div class="column">
				<related-post :module="'Schools'" :module_id="{{$school->id}}"></related-post>
			</div>
		</tab>

		<tab name="Overview">
						<div class="">
				<div class="mb-small">
					<p class="is-size-5-desktop">{{$school->name}} also known as {{$school->short_name}} is a {{$school->sponsored->name}} {{$school->typeOf()}} established in {{$school->date_created->format('Y')}} ({{$school->date_created->diffForHumans()}}). The school offers over {{$school->courses_count}} undergraduate courses, It is located in {{$school->state->name}}. 
						@if($school->website)

						{{ucfirst($school->short_name)}} has a public profile for anyone who wants to know more about the institution and can be accessed via its website. Visit {{$school->short_name}} landing page on {{$school->website}} or visit the school portal on {{$school->portal_website}} to apply for admission.

						@else 

						{{ucfirst($school->short_name)}} does not have an online public profile for students or prospective distant students to review before applying to the instition. If you wish to study in {{$school->short_name}}, we recommend that you visit the school to see for yourself if it has the qualities you're looking for. 

						@endif
					Other vital informations such as courses offered, UTME requirement, Direct Entry requirement, and the school photos are available below.
					</p>

					<h3 class="is-size-4 mt-3 ">Does {{ucfirst($school->short_name)}} have hostel accommodation</h3>
					@if($school->hostels_accomodation)
						<p class="is-size-5-desktop">{{$school->short_name}} has a provision for hostel accomodation to students who desire to live within the school premises. </p>
					@else
						 <p class="is-size-5-desktop">No! {{$school->short_name}} does not have provission for hostel accomodation at the moment. </p>
					@endif
					<p class="is-size-5-desktop">Hostels accomodation is dedicated to making students living stress free and to reduce the cost fee for renting a house outside the school premises.</p>


				</div>
			    @include ('sections/ads/in-article')
		

				<div class="mb-small">
					<div class="is-size-4 ">Description</div>
					<p class="is-size-5-desktop has-text-justified">{!! nl2br($school->description) !!}</p>

					<div class="section content">
						<h3>Recommended Articles</h3>
						@foreach ($school->posts as $followup)
							<a class=" is-size-5" href="{{$followup->path()}}">{{$followup->title}} Click to Read</a><br>
						@endforeach
					</div>
				    

				    To view a complete list of courses and their required cut off mark for {{$school->short_name}}. <a href="/courses-offered-in/{{$school->slug}}">Click here</a>
				    </p>

					<div class="is-size-4 mt-small">{{$school->short_name}} School Address?</div>
					<div class="content is-size-5-desktop has-text-justified">{{$school->name }} is located in {{$school->state->name}} State, {{$school->lga->name}} Local Government Area.</div>
					<div class="is-size-5-desktop">
						<div class="mt-small"><strong>School Address:</strong> {{$school->address}}</div>
						<div><strong>Phone Number: </strong> +234{{$school->phone}} </div>
						<div><strong>Email: </strong> {{$school->email}} </div>
						<div><strong>Website:</strong><a href="https://{{$school->website}}" target="_blank"> {{$school->website}}</a></div>
						<div><strong>Portal: </strong><a href="https://{{$school->portal_website}}" target="_blank"> {{$school->portal_website}}</a></div> 
					</div>
				{{-- <p>{!! nl2br(str_replace(" ", "&nbsp;", $school->description)) !!}</p> --}}
				</div>

				<h4 class="is-size-4 mt-large">Photos of {{ucfirst($school->name)}}</h4>
				<div class="section">
					<image-carousel :wraparound="true" :autoplay="true" >
				        @foreach ($school->photos as $photo)
				            <div class="card" style="width: 260px; margin: 0 10px;">
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
			</div>
		</tab>


		<tab name="Requirement">
			<h3 class="is-size-4">{{ucfirst($school->short_name)}} cut off mark {{date('Y')}}</h3>
		    <p class="is-size-5-desktop has-text-justified">The average cut off mark for {{$school->short_name}} is {{$school->jamb_points}}. It is important to note that this cut off mark may not be applicable for all courses, some courses may require you to score higher, while some even lower.</p>
		</tab>


		<tab name="Courses">
			<div class="mt-small">
				<h4 class="is-size-4">{{ucfirst($school->name)}} courses and departments:</h4>
				<div class="is-size-5-desktop mb-small">The following is a list of courses offered in {{$school->short_name}} </div>
				
				<table class="table">
					<thead>
						<tr>
							<th><abbr title="School">Courses</abbr></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($school->courses as $course)
							<tr>
								<td><a href="{{$course->path()}}">{{$course->name}}</a></td>
							</tr>	
						@endforeach
					</tbody>
				</table>

				@include ('sections/ads/v-banner')
			</div>
		</tab>
		<tab name="Articles">

			<div class="content">
				<p>Frequent questions asked</p>
				<ul>
					@foreach ($school->posts as $followup)
						<li>
							<a class=" is-size-4" href="{{$followup->path()}}">{{$followup->title}}</a>
						</li>
					@endforeach
				</ul>
			</div>
		</tab>
		<tab name="Related Schools">
			<div>
				<h3 class="is-size-4 mb-4">See Also Other {{$school->typeOf()}} Institutions </h3>
				<div class="tile is-ancestor wrap-elements">
					@foreach($relatedschools as $relatedschool)
						<div class="tile is-3 is-parent">
							<div class="card mb-small">
								<div class="card-image">
								    <figure class="image is-4by3">
								      <img src="{{asset($relatedschool->logo_path)}}" alt="{{$relatedschool->short_name}} logo">
								    </figure>
								</div>
							    <div class="card-content">
							     	<p>{{$relatedschool->name}}</p>
							    </div>
							    <footer class="exam card-footer">
							      <a href="{{$relatedschool->path()}}" class="card-footer-item"><i class="fas fa-binoculars"></i>View</a>
							    </footer>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</tab>
	</tabs>

	<div class="section">
		<a class="button is-link is-outlined" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url($school->path()) }}&display=popup">
		<img style="width: 20px; margin-right: .4em;" src="{{url('/images/facebook.svg')}}"> Share Post </a>

		<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-via="@NSISnews" data-hashtags="Nigeria News, Asu, WaecNigeria, jamb" data-related="NSISnews,S_techmax" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div>
</div>

@endsection