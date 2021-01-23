<label class="checkbox sort_school_options">
	<input type="checkbox"  @click="setOptions" v-model="checkedNames" value="" selected>
	All
</label>

<label class="checkbox sort_school_options">
	<input type="checkbox"  @click="setOptions" v-model="checkedNames" value="/schools/type/university?a=admitting">
	Still Admitting
</label>

@foreach ($programme as $programme)

	<label class="checkbox sort_school_options">
		<input id="{{$programme->id}}"  type="checkbox"  @click="setOptions" v-model="checkedNames" value="{{$programme->path()}}?">
		{{$programme->name}}
	</label>

@endforeach

<label class="checkbox sort_school_options" v-for="(sort, index) in sortLinks">
	<input :id="index" type="checkbox" v-model="checkedNames" @click="setOptions"  :value="sort.value">
	@{{ sort.name }}
</label><br>