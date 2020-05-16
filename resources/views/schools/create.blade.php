@extends('layouts.app')
@section('content')
	<div class="container">
		<new-school
			@isset ($school)
			 :data="{{$school}}" 
			@endisset
		 inline-template>
			<div class="section ">
				<div class="has-text-centered" v-if="showMatchedWarning">
					<span class="is-size-5">Wait! These schools are similar to your new school</span>
					<ul>
						<li v-for="school in matchedSchools" v-text="'* ' + school.name"></li>
					</ul>
					<span>Do you still want to continue?</span> 
					<button @click="matchedSchools = ''">Yes</button>
					<button @click="$modal.hide('new-school')">No</button>
				</div>
				<div v-show="showErrors" class="is-danger">Your Form contain errors Please review all steps</div>
				<form v-show="steps == 1" @submit.prevent="createSchool" @change="errorMessage=''">
					<div>
						<div class="is-size-4 has-text-centered	mb-small">Basic Information</div>
						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Name</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="schoolForm.name" @change="findSchool" class="input" type="text" placeholder="Enter School Name">
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('name')" v-text="schoolForm.errors.get('name')">
						      </p>
						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Shortname</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input @change="findSchool" v-model="schoolForm.short_name" required class="input" type="text" placeholder="E.g JAMB">
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('short_name')" v-text="schoolForm.errors.get('short_name')"></p>
						      </p>
						    </div>
						  </div>
						</div>


						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Type</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <div class="select is-fullwidth">
						          <select v-model="schoolForm.school_type_id" required>
						            <option value="">Pick a type</option>
						            <option v-for="type in types" :value="type.id" v-text="type.name"></option>
						          </select>
						        </div>
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('school_type_id')" v-text="schoolForm.errors.get('school_type_id')"></p>

						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Sponsor</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <div class="select is-fullwidth">
						          <select v-model="schoolForm.sponsored_id" required>
						            <option value="">Pick a Sponsor</option>
						            <option v-for="sponsore in sponsored" :value="sponsore.id" v-text="sponsore.name"></option>
						          </select>
						        </div>
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('sponsored_id')" v-text="schoolForm.errors.get('sponsored_id')"></p>

						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
		  				  	<div class="field-label is-normal">
		    					<label class="label">Sites</label>
						  	</div>
						  	<div class="field-body">
							    <div class="field">
							      <p class="control is-expanded">
							        <input v-model="schoolForm.website" class="input" type="text" placeholder="Website">
							      </p>
						      <p class="help is-danger" v-if="schoolForm.errors.has('website')" v-text="schoolForm.errors.get('website')"></p>

							    </div>
							    <div class="field">
							      <p class="control is-expanded">
							        <input v-model="schoolForm.portal_website" class="input is-success" type="text" placeholder="Portal" value="">
							      </p>
						      <p class="help is-danger" v-if="schoolForm.errors.has('portal_website')" v-text="schoolForm.errors.get('portal_website')"></p>

							    </div>
							 </div>
						</div>


						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">Jamb Point</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="schoolForm.jamb_points" class="input" type="number" placeholder="Enter Points">
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('jamb_points')" v-text="schoolForm.errors.get('jamb_points')"></p>
						      
						    </div>
						  </div>
						</div>
					</div>
					<div class="section">
						<div class="is-size-4 has-text-centered	mb-small">Location/Contact</div>
						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*State</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <div class="select is-fullwidth">
						          <select @change="statelgas" v-model="schoolForm.states_id" required>
						            <option value="">Select State</option>
						            <option v-for="state in states" :value="state.id" v-text="state.name"></option>
						          </select>
						        </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('states_id')" v-text="schoolForm.errors.get('states_id')"></p>

						      </div>
						    </div>
						  </div>
						</div>
						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*LGA</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <div class="select is-fullwidth">
						          <select v-model="schoolForm.lga_id" required>
						            <option v-for="lga in lgas" :value="lga.id" v-text="lga.name"></option>
						          </select>
						        </div>
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('lga_id')" v-text="schoolForm.errors.get('lga_id')">
						      </p>
						    </div>
						  </div>
						</div>
						
						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Address</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="schoolForm.address" required class="input" type="text" placeholder="School Location">
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('address')" v-text="schoolForm.errors.get('address')"></p>
						      
						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label"></div>
						  <div class="field-body">
						    <div class="field is-expanded">
						      <div class="field has-addons">
						        <p class="control">
						          <a class="button is-static">
						            +234
						          </a>
						        </p>
						        <p class="control is-expanded">
						          <input v-model="schoolForm.phone" class="input" type="tel" placeholder="Phone">
						        </p>
						      </div>
						      <p class="help">Do not enter the first zero</p>
						      <p class="help is-danger" v-if="schoolForm.errors.has('phone')" v-text="schoolForm.errors.get('phone')">
						      </p>
						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">Email</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="schoolForm.email" class="input" type="email" placeholder="support@stechmax.com">
						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('email')" v-text="schoolForm.errors.get('email')">
						      </p>
						    </div>
						  </div>
						</div>
					</div>	
					<div class="section">
						<div class="is-size-4 has-text-centered	mb-small">Bio Data</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Description</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
							  	
							  	<editor :value="schoolForm.description" @content="setPostBody"></editor>

						      </div>
						      <p class="help is-danger" v-if="schoolForm.errors.has('description')" v-text="schoolForm.errors.get('description')"></p>

						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label">
						    <!-- Left empty for spacing -->
						  </div>
						  <div class="field-body">
						    <div class="field is-fullwidth">
						      <div class="control">
						        <button type="submit" :class="processing ? 'is-loading' : '' " class="button is-primary" v-text="school ? 'Update School' : 'Create School' ">
						          
						        </button>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				</form>

				<div v-if="school != '' && steps == 2">
					<div class="has-text-centered is-size-3">School Images</div>
					<div>
						<school-images :photosdata="{{$photos}}" :school="school"></school-images>
					</div>
				</div>

				<div v-if="school != '' && steps == 3">
					<div class="has-text-centered">Attach Courses to this School</div>
					<attach-courses :school="school"></attach-courses>
				</div>
				<div v-if="!showMatchedWarning" class="mt-medium buttons is-centered">
					<button class="button" @click="steps --" :disabled="steps === 1">Prev</button>
					<button class="button" @click="steps ++" :disabled="steps === max_steps">Next</button>
				</div>
			</div>
		</new-school>
	</div>
@endsection