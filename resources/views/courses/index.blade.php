@extends('layouts.app')


@section('title')
    Complete List of courses offered in Schools | NSIS
@endsection

@section('head')
    <meta name="description" content="Here is a complete list of courses offered in Nigeria Universities, Polytechnics, Colleges, Nurses etc.">
  	<meta name="keywords" content="Nigeria Education Courses Offered"> 
@endsection


@section('content')

<courses-page inline-template>
	<div class="container">
		<div class="mt-medium">
			<div class="section">
				<h2 class="has-text-centered content">Courses offered in Nigeria Universities, Polytechnics, Colleges, Nurses etc.</h2>
			</div>
			<div class="columns is-gapless">
				<div class="column is-hidden-touch">
					@include('courses.partials.sortCourses')
				</div>
				<div class="column is-three-quarters">
					<div class="">
						<div class="field is-hidden-desktop">
						  <div class="control has-icons-left">
						    <div class="select is-fullwidth">
								<select v-model="sort">
							    <option value="" selected>Sort By Faculty</option>
							  	@foreach ($faculties as $faculty)
							    	<option value="{{$faculty->slug}}">{{$faculty->name}}</option>
					            @endforeach

							  </select>
						    </div>
						    <div class="icon is-small is-left">
						      <i class="fas fa-filter"></i>
						    </div>
						  </div>
						</div>
						<div class="field is-hidden-desktop">
							<div class="control has-icons-left">
								<div class="select is-fullwidth">
								  <select v-model="path">
								  	<option value="" selected>Sort by Programme</option>
								  	@foreach ($programme as $programme)
								    	<option id="{{$programme->id}}" value="{{$programme->slug}}">{{$programme->name}}</option>
						            @endforeach
								  </select>
							    </div>
							</div>
						</div>
						<div class="field">
						  <p class="control has-icons-left has-icons-right" :class="isLoading ? 'is-loading' : '' ">
							<input @keyUp="search" v-model="searchKey" class="input mb-medium" type="text" placeholder="Quick Search">
						    <span class="icon is-small is-left">
						      <i class="fas fa-search"></i>
						    </span>
						  </p>
						</div>

						<span v-for="(course, index) in courses">
							@include('courses.partials.courseCard')
						</span>
		  	            <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="true"></b-loading>

				        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
					</div>
				</div>
			</div>
		</div>
	</div>
</courses-page>
@endsection