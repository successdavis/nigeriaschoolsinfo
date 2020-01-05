@extends('layouts.app')
@section('content')
<div class="section">
	<p class="has-centered-text">Hi! this section is coming soon</p>
	<h1 class="is-size-4 mb-small">{{$school->name}}</h1>
	<p>{{$school->description}}</p>
</div>

@endsection