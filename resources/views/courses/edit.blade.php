@extends('layouts.app')
@section('content')
	here is the edit form 
    <attach-schools :course="{{$course}}"></attach-schools>
    <attach-subjects :course="{{$course}}"></attach-subjects>
@endsection