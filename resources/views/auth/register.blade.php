@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section" style="max-width: 600px; margin: auto">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="field">
              <div class="control has-icons-left has-icons-right">
                <input required class="input is-success" type="text" placeholder="Your name here" id="name" name="name" value="{{ old('name') }}">
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </div>
            </div>
            <div class="field mt-medium">
                <p class="control has-icons-left has-icons-right">
                    <input name="email" class="input" type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="icon is-small is-left">
                      <i class="fas fa-envelope"></i>
                    </span>
                    {{-- <span class="icon is-small is-right">
                      <i class="fas fa-check"></i>
                    </span> --}}
                </p>
                @error('email')
                    <p role="alert" class="help is-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="field mt-medium">
              <p class="control has-icons-left">
                <input class="input" id="password" name="password" type="password" placeholder="Password" required autocomplete="current-password">
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
                @error('password')
                    <p role="alert" class="help is-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="field mt-medium">
              <p class="control has-icons-left">
                <input class="input" id="password-confirm" name="password_confirmation" type="password" placeholder="Password" required autocomplete="current-password">
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
                @error('password-confirm')
                    <p role="alert" class="help is-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="field mt-medium">
              <p class="control">
                <button class="button is-success is-fullwidth">
                  Register
                </button>
              </p>
            </div>
            <div>Already have an account? <a href="/login">Login</a></div>

        </form>
    </div>
</div>
@endsection
