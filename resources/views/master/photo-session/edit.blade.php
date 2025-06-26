@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | Edit {{ $title }}</title>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Photo Sessions') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('photo-session.index') }}">{{ __('Photo Sessions') }}</a>
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
                    <h4 class="card-title">{{ __('Edit Session') }}</h4>
                </div>

                <form action="{{ route('photo-session.update', Crypt::encrypt($data->id)) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row form-group mb-1">
                            <label class="col-sm-3 form-label" for="code">{{ __('Code*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror"
                                    value="{{ old('code', $data->code) }}" placeholder="Enter Code">
                                @error('code')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-1">
                            <label class="col-sm-3 form-label" for="name">{{ __('Name*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $data->name) }}" placeholder="Enter Name">
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
                                    <option value="1" {{ old('type', $data->type) == '1' ? 'selected' : '' }}>{{ __('Indoor') }}</option>
                                    <option value="0" {{ old('type', $data->type) == '0' ? 'selected' : '' }}>{{ __('Outdoor') }}</option>
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-1">
                            <label class="col-sm-3 form-label" for="start_time">{{ __('Start Time*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="start_time" name="start_time"
                                    class="form-control flatpickr-time text-start @error('start_time') is-invalid @enderror"
                                    value="{{ old('start_time', $data->start_time) }}" placeholder="HH:MM">
                                @error('start_time')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-1">
                            <label class="col-sm-3 form-label" for="end_time">{{ __('End Time*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="end_time" name="end_time"
                                    class="form-control flatpickr-time text-start @error('end_time') is-invalid @enderror"
                                    value="{{ old('end_time', $data->end_time) }}" placeholder="HH:MM">
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        <a href="{{ route('photo-session.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/scripts/forms/form-select2.js') }}"></script>
@endpush
