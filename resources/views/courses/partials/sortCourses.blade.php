<label class="checkbox sort_school_options">
	<input  type="checkbox"  @click="setOptions" v-model="checkedFaculty" value="">
	All
</label>
@foreach ($faculties as $faculty)

	<label class="checkbox sort_school_options">
		<input id="{{$faculty->id}}"  type="checkbox"  @click="setOptions" v-model="checkedFaculty" value="{{$faculty->slug}}">
		{{$faculty->name}}
	</label>

@endforeach