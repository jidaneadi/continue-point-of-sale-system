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
                <h2 class="content-header-title float-start mb-0">{{ __('Discounts') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">{{ __('Manage Product') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('discount.index') }}">{{ __('Discounts') }}</a>
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
                        <h4 class="card-title">{{ __('Edit Discount') }}</h4>
                    </div>

                    <form action="{{ route('discount.update', Crypt::encrypt($data->id)) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Product*') }}</label>
                                <div class="col-sm-9">
                                    <select id="product" name="product" class="form-select">
                                        <option disabled hidden>{{ __('-- Select Product Category --') }}</option>
                                        
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ old('product', $data->product_id) == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('product')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="discount">{{ __('Discount (%)*') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" id="discount" name="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount', $data->discount) }}" placeholder="Enter Discount">
                                    
                                    @error('discount')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="start_date">{{ __('Start Date*') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" id="start_date" name="start_date" class="form-control flatpickr-basic @error('start_date') is-invalid @enderror" value="{{ old('start_date', $data->start_date) }}" placeholder="YYYY-MM-DD">
                                    
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="end_date">{{ __('End Date*') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" id="end_date" name="end_date" class="form-control flatpickr-basic @error('end_date') is-invalid @enderror" value="{{ old('end_date', $data->end_date) }}" placeholder="YYYY-MM-DD">
                                    
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            <a href="{{ route('discount.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
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