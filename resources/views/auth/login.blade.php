@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ __('Login') }}</title>
@endsection

@section('content')
    <h4 class="card-title fw-bolder">{{ __('Welcome to Arts!') }} 👋</h4>

    <form class="auth-login-form" action="{{ route('login') }}" method="POST">
        @csrf
        @method("POST")

        <div class="mb-1">
            <label class="form-label" for="login-email">{{ __('Email') }}</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" required autocomplete="email" autofocus />

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">{{ __('Password') }}</label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>{{ __('Forgot Your Password?') }}</small>
                    </a>
                @endif
            </div>
            
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" id="password" name="password" class="form-control form-control-merge @error('password') is-invalid @enderror" placeholder="Enter Your Password" required autocomplete="current-password" autofocus />
                <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                </span>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-1">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember-me">{{ __('Remember Me') }}</label>
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100">{{ __('Login') }}</button>
    </form>
@endsection