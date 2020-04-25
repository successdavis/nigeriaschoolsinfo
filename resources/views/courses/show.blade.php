@extends('layouts.app')

@section('title')
    {{$courses->name}} | {{$courses->short_name}} | NSIS
@endsection

@section('head')
    <meta name="description" content="All you need to knw about {{$courses->name}} and guide to get admission into any university to study {{$courses->short_name}}">
  	<meta name="keywords" content="Nigeria Education Courses Offered"> 
@endsection

@section('content')
<div class="container">
	<div class="columns">
		<div class="column is-three-quarters">
			<div class="section">
				
				<h1 class="is-size-3 mb-medium">{{$courses->name}}</h1>
				<h2 class="is-size-3">{{$courses->short_name}} JAMB Subjects</h2>
				@foreach ($courses->subjects as $subject)
					<div>{{$subject->name}}</div>
				@endforeach
				<div>{{$courses->utme_comment}}</div>


				<h2 class="is-size-3">{{$courses->short_name}} UTME Requirements</h2>
				<div class="mb-medium">{{$courses->utme_requirements}}</div>
				<h2 class="is-size-3">{{$courses->short_name}} Direct Entry Requirements</h2>
				<div class="mb-small">{{$courses->direct_requirements}}</div>
				{{$courses->short_name}} job description
				<p class="is-size-5">{!! nl2br($courses->description) !!}</p>

				<h2 class="is-size-3 mt-medium">{{$courses->short_name}} Special Consideration</h2>
				{{-- @foreach ($courses->considerations as $consideration)
					<div>{!! nl2br($consideration->consideration) !!}</div>
				@endforeach --}}

				<h2 class="is-size-3 mt-medium">Click here to view List of schools offering {{$courses->name}}</h2>
				<div><a href="/schools-offering/{{$courses->slug}}">Click to View Schools</a></div>

			</div>
		</div>
		<div class="column">
			
		</div>
	</div>
</div>
@endsection