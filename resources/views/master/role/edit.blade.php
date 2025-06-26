@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Roles') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">{{ __('Manage Account') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ url()->route('role.index') }}">{{ __('Roles') }}</a>
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

                    <form action="{{ url()->route('role.update', Crypt::encrypt($data->uuid)) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="name">{{ __('Role Name*') }}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? collect(explode(' ', str_replace('-', ' ', $data->name)))->map(function ($word) { return preg_match('/[aeiou]/i', $word) ? ucwords($word) : strtoupper($word); })->implode(' ') }}" placeholder="Enter Role Name">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Permissions') }}</label>

                                <div class="col-sm-9">
                                    <select id="permission" name="permission[]" class="select2 form-select" multiple data-placeholder=" -- Select Role --">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->name }}" {{ in_array($permission->name, old('roles', $data->permissions->pluck('name')->toArray())) ? 'selected' : '' }}>
                                                {{ collect(explode(' ', str_replace('-', ' ', $permission->name)))->map(function ($word) { return preg_match('/[aeiou]/i', $word) ? ucwords($word) : strtoupper($word); })->implode(' ') }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('permission')
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
                            <a href="{{ url()->route('role.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/scripts/forms/form-select2.js') }}"></script>
@endpush