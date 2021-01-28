@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section content" style="max-width: 600px; margin: auto">
        <p>Open your email address and click on the link that was sent upon completing your registration</p>
        <p>If you cannot find the link please check or spam folder or click the button below to resend</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="button is-link">Resend Verification Link</button>
        </form>
        <div>Dont have an account? <a href="/register">Register Here</a></div>
    </div>
</div>
@endsection
