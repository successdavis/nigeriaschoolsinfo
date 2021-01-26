<label class="checkbox sort_school_options">
	<input  type="checkbox"  @click="setOptions" v-model="checkedFaculty" value="">
	All
</label>
@foreach ($programme as $programme)

	<label class="checkbox sort_school_options">
		<input id="{{$programme->id}}"  type="checkbox"  @click="setPath" v-model="checkedFaculty" value="{{$programme->slug}}">
		{{$programme->name}}
	</label>

@endforeach
@foreach ($faculties as $faculty)
	<label class="checkbox sort_school_options">
		<input id="{{$faculty->id}}"  type="checkbox"  @click="setOptions" v-model="checkedFaculty" value="{{$faculty->slug}}">
		{{$faculty->name}}
	</label>
@endforeach