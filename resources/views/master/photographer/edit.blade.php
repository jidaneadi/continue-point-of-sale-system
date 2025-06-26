@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
@endsection

@push('css')
    
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Photographers') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">{{ __('Manage Account') }}</li>
                        <li class="breadcrumb-item">{{ __('User') }}</li></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('photographer.index') }}">{{ __('Photographers') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ url()->current() }}">{{ __('Edit') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>

                    <form action="{{ url()->route('photographer.update', Crypt::encrypt($photographer->id)) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="name">{{ __('Full Name*') }}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}" placeholder="Enter Full Name">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Type*') }}</label>
                                <div class="col-sm-9">
                                    <select id="type" name="type" class="select2 form-select">
                                        <option disabled hidden>{{ __('-- Select Type --') }}</option>
                                        <option value="1" {{ old('type', $photographer->type) == '1' ? 'selected' : '' }}>{{ __('Indoor') }}</option>
                                        <option value="0" {{ old('type', $photographer->type) == '0' ? 'selected' : '' }}>{{ __('Outdoor') }}</option>
                                    </select>

                                    @error('type')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Email*') }}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" placeholder="Enter Email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Save Change') }}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{ __('Reset') }}</button>
                            <a href="{{ url()->route('photographer.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')

@endpush