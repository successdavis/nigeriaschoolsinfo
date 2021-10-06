@extends('layouts.app')

@section('content')
<div class="container">
	{{-- ==== Google Adsense Display Ads ===== --}}
    @include ('sections/ads/horizontal_banner')
</div>

<exams-page inline-template>
	<div class="container">	
		<div class="section">
			<div class="field is-hidden-desktop">
				<div class="control has-icons-left">
					<div class="select is-fullwidth">
						<select v-model="status" @change="sortItems">
							<option value="" selected>All</option>
							<option value="open" >Open</option>
							<option value="close" >Closed</option>
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


			<div class="tile is-ancestor wrap-elements">
				@include('exams.partials.examCard')
			</div>
	        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
		</div>

		
	</div>
</exams-page>
@endsection