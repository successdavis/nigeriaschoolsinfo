@extends('layouts.app')
@section('title')
    List of Universities, Polytechnic, and Collegs in Nigeria
@endsection

@section('head')
    <meta name="description" content="Browse the complete list of Universites, Polytechnics, Colleges, Nurses and other degree awarding institutions in Nigeria use the sort and search">
  	<meta name="keywords" content="Project Topics, Education projects"> 
@endsection


@section('content')

{{-- ====Google Adsense Banner Ads --}}
@include ('sections/ads/horizontal_banner')

<shools-page inline-template>
	<div class="container">
		<div class="mt-medium remove-max-width">
			<div class="section has-text-centered">
				<h2 class="is-size-5">List of Universites, Polytechnics, Colleges, Nurses and other degree awarding institutions in Nigeria</h2>
				<div>Please use the sort and search here to quickly navigate and find any school</div>
				<div class="is-hidden-desktop">Click the eye to view courses for each school</div>
			</div>
			<div class="columns">
				<div class="column is-hidden-touch section">
					@include('schools.partials.sortSchools')
				</div>
				<div class="column is-three-quarters">
					<div class="section">
						<div class="field is-hidden-desktop">
						  <div class="control has-icons-left">
						    <div class="select is-fullwidth">
						      <select v-model="path" @change="sort">
							    <option value="" selected>All</option>
							    <option value="/schools/type/university?a=admitting">Still Admitting</option>
							  	@foreach ($programme as $programme)
							    	<option value="{{$programme->path()}}?">{{$programme->name}}</option>
					            @endforeach
							    <option v-for="sort in sortLinks" value="/schools/type/university?q=federal" v-text="sort.name"></option>
							  </select>
						    </div>
						    <div class="icon is-small is-left">
						      <i class="fas fa-filter"></i>
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

						<span v-for="(school, index) in schools">
							@include('schools.partials.schoolCard')
						</span>
				        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
					</div>
				</div>
			</div>
		</div>
	</div>
</shools-page>
@endsection