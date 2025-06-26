@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ __('Register') }}</title>
@endsection

@section('content')
    <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
    <p class="card-text mb-2">Make your app management easy and fun!</p>

    <form class="auth-register-form" action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-1">
            <label class="form-label" for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-1">
            <label class="form-label" for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="email" />
            
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-1">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" id="password" name="password" class="form-control form-control-merge @error('password') is-invalid @enderror" placeholder="Enter Your Password" required autocomplete="new-password" />
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
            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-merge @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Your Password" required autocomplete="new-password" />
                <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                </span>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger w-100">{{ __('Register') }}</button>

        <p class="text-center mt-2">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}">
                <span>{{ __('Login here') }}</span>
            </a>
        </p>
    </form>
@endsection