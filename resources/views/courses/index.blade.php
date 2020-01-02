@extends('layouts.app')
@section('content')
<courses-page inline-template>
	<div class="container">
		<div class="mt-medium remove-max-width">
			<div class="columns">
				<div class="column is-hidden-touch section">
					@include('courses.partials.sortCourses')
				</div>
				<div class="column is-three-quarters">
					<div class="section">
						<div class="field is-hidden-desktop">
						  <div class="control has-icons-left">
						    <div class="select is-fullwidth">

						      <select v-model="sort">
							    <option value="" selected>All</option>
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
				        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
					</div>
				</div>
			</div>
		</div>
	</div>
</courses-page>
@endsection