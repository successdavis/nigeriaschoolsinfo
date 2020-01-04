@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section" style="max-width: 600px; margin: auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <div class="field mt-medium">
              <p class="control">
                <button class="button is-success is-fullwidth">
                  Login
                </button>
              </p>
            </div>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
        <div>Dont have an account? <a href="/register">Register Here</a></div>
    </div>
</div>
@endsection
