@extends('layouts.app')
@section('content')
<shools-page inline-template>
	<div class="section">
		<div class="field">
		  <div class="control has-icons-left">
		    <div class="select is-fullwidth">
		      <select v-model="path" @change="sort">
			    <option value="" selected>All</option>
			    <option value="/schools/type/university?a=admitting">Still Admitting</option>
			  	@foreach ($schooltype as $type)
			    	<option value="{{$type->path()}}?">{{$type->name}}</option>
	            @endforeach
			    <option value="/schools/type/university?q=federal">Federal Universities</option>
			    <option value="/schools/type/university?q=state">State Universities</option>
			    <option value="/schools/type/university?q=private">Private Universities</option>
			    <option value="/schools/type/polytechnic?q=federal">Federal Polytechnics</option>
			    <option value="/schools/type/polytechnic?q=state">State Polytechnics</option>
			    <option value="/schools/type/polytechnic?q=private">Private Polytechnics</option>
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

		<span v-for="(school, index) in schools">
			@include('schools.partials.schoolCard')
		</span>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
	</div>
</shools-page>
@endsection