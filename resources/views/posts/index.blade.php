@extends('layouts.app')

@section('title')
	Latest Nigeria Education News | Nigeria Schools Info
@endsection

@section('head')
	<meta name="description" content="Stay up to date with latest Nigeria Educational News on all Universities, Polytechnic, Colleges, Nurses School, JAMB, WAEC Etc.">
  	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
@endsection

@section('content')
	<div>
		@include ('sections/ads/horizontal_banner')
	</div>
	
	<div class="container">
		<div>
			<div class="mb-medium">
			
			</div>
			
			<div class="columns is-gapless">
				<div class="column is-three-quarters">
					<div >
						<div class="mb-large">
							<form action="/latest-nigeria-education-news">
								@csrf
							    <div class="field is-grouped">
								  <p class="control is-expanded">
								    <input name="q" value="{{$q}}" class="input" type="text" placeholder="Find a repository">
								  </p>
								  <p class="control">
								  	<button type="submit" class="button is-info">
								  		Go
								  	</button>
								  </p>
								</div>
							</form>
						</div>

						<div class="is-hidden-touch">
							@include ('sections/ads/in-feed')
						</div>


						<tabs>
							<tab name="Posts" selected="true">
								@foreach ($posts as $post)
					                @if (view()->exists("posts.partials.{$post->source->getShortName()}"))
					                    @include ("posts.partials.{$post->source->getShortName()}")
					                @endif
					            @endforeach
							</tab>
							<tab name="{{date('Y')}}/{{date('Y') + 1}} Schools Admitting">
								<div class="mb-medium">
									<a href="/schools" class="button is-primary small is-fullwidth is-expanded">View Full List Here</a>
								</div>
								@foreach($schoolsAdmitting as $school)
									<a href="{{$school->path()}}">
										<article class="media">
										  <figure class="media-left">
										    <p class="image is-64x64">
										      <img class="is-rounded" src="{{asset($school->logo_path)}}" alt="{{$school->name}} thumbnail">
										    </p>
										  </figure>
										  <div class="media-content">
										    <div class="content">
										      <p>
										        <strong>Reg Ends:</strong> <small>{{$school->reg_ends_at->diffForHumans()}}</small>
										        <br>
										        {{$school->name}}
										      </p>
										    </div>
										  </div>
										</article>
									</a>
								@endforeach
							</tab>
						</tabs>



						<div class="section">
							{{ $posts->links() }}
						</div>
					</div>
				</div>
				<div class="column is-size-4">
					<div class="mb-medium">Trending News</div>

					@foreach ($trending as $trend)
						<article class="media">
						  <div class="media-content">
						      <a href="{{$trend->path()}}" class="control has-text-black">
					              {{$trend->title}} <br>
					              <span class="is-size-7">posted: {{$trend->created_at->diffForHumans()}}</span>
						      </a>
						  </div>
						  {{-- <figure class="media-right" style="margin-top: 10px">
						    <p class="image is-32x32">
						      <img src="{{asset($trend->source->logo_path)}}">
						    </p>
						  </figure> --}}
						</article>
					@endforeach	
				</div>
			</div>
		</div>
	</div>
@endsection