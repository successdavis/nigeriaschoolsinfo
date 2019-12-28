@extends('layouts.app')
@section('content')
<shools-page inline-template>
	<div class="section">
		<div class="field">
		  <div class="control has-icons-left">
		    <div class="select is-fullwidth">
		      <select v-model="type">
			    <option value="" selected>All</option>
			    <option>Still Admitting</option>
			  	@foreach ($schooltype as $type)
			    	<option>{{$type->name}}</option>
	            @endforeach
			    <option>Federal Universities</option>
			    <option>State Universities</option>
			    <option>Private Universities</option>
			    <option>Federal Polytechnics</option>
			    <option>State Polytechnics</option>
			    <option>Private Polytechnics</option>
			  </select>
		    </div>
		    <div class="icon is-small is-left">
		      <i class="fas fa-filter"></i>
		    </div>
		  </div>
		</div>

		<div class="field">
		  <p class="control has-icons-left has-icons-right" :class="isLoading ? 'is-loading' : '' ">
			<input class="input mb-medium" type="text" placeholder="Quick Search">
		    <span class="icon is-small is-left">
		      <i class="fas fa-search"></i>
		    </span>
		  </p>
		</div>

		<span v-for="(school, index) in schools.data">
			@include('schools.partials.schoolCard')
		</span>
        <paginator :dataSet="dataSet" @changed.prevent="fetch"></paginator>
	</div>
</shools-page>
@endsection