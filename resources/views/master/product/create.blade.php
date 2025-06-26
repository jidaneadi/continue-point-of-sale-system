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
                <h2 class="content-header-title float-start mb-0">{{ __('Products') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">{{ __('Manage Product') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ url()->route('product.index') }}">{{ __('Products') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ url()->current() }}">{{ __('Create') }}</a>
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

                    <form action="{{ url()->route('product.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method("POST")

                        <div class="card-body">
                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="name">{{ __('Name*') }}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Name">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="photo">{{ __('Image*') }}</label>

                                <div class="col-sm-9">
                                    <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" value="{{ old('photo') }}">

                                    @error('photo')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="price">{{ __('Price*') }}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Enter Price">

                                    @error('price')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label" for="description">{{ __('Description*') }}</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Product Category*') }}</label>

                                <div class="col-sm-9">
                                    <select id="product_category" name="product_category" class="form-select" data-placeholder=" -- Select Product Category --">
                                        <option disabled>{{ __('-- Select Product Category --') }}</option>
                                        
                                        @foreach($productCategories as $productCategory)
                                            <option value="{{ $productCategory->id }}" {{ old('product_category') ? "selected": "" }}>{{ $productCategory->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_category')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Type*') }}</label>

                                <div class="col-sm-9">
                                    <select id="type" name="type" class="form-select">
                                        <option disabled>{{ __('-- Select Type --') }}</option>
                                        <option value="1" {{ old('type') == 'indoor' ? 'selected' : '' }}>{{ __('Indoor') }}</option>
                                        <option value="0" {{ old('type') == 'outdoor' ? 'selected' : '' }}>{{ __('Outdoor') }}</option>
                                    </select>

                                    @error('type')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group mb-1">
                                <label class="col-sm-3 form-label">{{ __('Photo Sessions*') }}</label>

                                <div class="col-sm-9">
                                    <select id="photo_sessions" name="photo_sessions[]" class="select2 form-select" multiple data-placeholder=" -- Select Photo Sessions --">
                                        <option disabled>{{ __('-- Select Photo Sessions --') }}</option>
                                        
                                        @foreach($photoSessions as $photoSession)
                                            <option value="{{ $photoSession->id }}" {{ ( in_array($photoSession->id, old('photo_sessions') ?? []) ? "selected": "") }}>{{ $photoSession->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('photo_sessions')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{ __('Reset') }}</button>
                            <a href="{{ url()->route('product.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
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