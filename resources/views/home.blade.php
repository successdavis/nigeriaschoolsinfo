@extends('layouts.app')

@section('title')
    Your personal dashboard
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="trix.css">
    <script type="text/javascript" src="trix.js"></script> 
@endsection

@section('content')
<div class="container">
    <div class="section">
        <h3 class="is-size-4 is-centered">Hello! {{auth()->user()->name}}</h3>
        <p class="mt-small">Welcome to your dashboard</p>
        <p>Please note that this section is still under construction</p>
        <h3 class="is-size-4 mt-medium">Quick Links</h3>
        <a href="/courses">Browse Courses</a> <br>
        <a href="/courses">Browse Schools</a> <br>
        <a href="/courses">Browse Exams</a> <br>
    </div>


    @if (auth()->user()->isAdmin())
        {{-- <new-school></new-school> --}}
        <a href="{{ route('schools.create') }}" class="button">Create School</a>
        <new-course></new-course>
        <a class="button" href="/posts/newpost">Create Post</a>
    @endif
</div>
@endsection


