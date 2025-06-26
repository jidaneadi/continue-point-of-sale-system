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
                <h2 class="content-header-title float-start mb-0">{{ __('Transactions') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Master') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.index') }}">{{ __('Transactions') }}</a>
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

                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-1">
                                <label class="col-sm-3 form-label" for="customer">{{ __('Customer*') }}</label>
                                <div class="col-sm-9">
                                    <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror" required>
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $cust)
                                            <option value="{{ $cust->id }}">{{ $cust->user->name ?? 'No Name' }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label class="col-sm-3 form-label" for="payment_method">{{ __('Payment Method*') }}</label>
                                <div class="col-sm-9">
                                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                        <option disabled>Select Payment Method</option>
                                        <option value="cash">Cash</option>
                                        <option value="qris">QRIS</option>
                                        <option value="gopay">GoPay</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-2">Product Details</h5>

                            <div id="product-wrapper">
                                <div class="row product-item mb-2">
                                    <div class="col-md-4 mb-1">
                                        <label>Product</label>
                                        <select name="product_id[]" class="form-control" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label>Photo Session</label>
                                        <select name="photo_session_id[]" class="form-control">
                                            <option value="">Optional</option>
                                            @foreach($photoSessions as $session)
                                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-1">
                                        <label>Photographer</label>
                                        <select name="photographer_id[]" class="form-control">
                                            <option value="">Optional</option>
                                            @foreach($photographers as $pg)
                                                <option value="{{ $pg->id }}">{{ $pg->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1 mb-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-outline-danger remove-product">×</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <button type="button" id="add-product" class="btn btn-outline-primary btn-sm">
                                    <i data-feather="plus"></i> Add Another Product
                                </button>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{ __('Reset') }}</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-outline-warning">{{ __('Back') }}</a>
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

    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('#add-product').on('click', function () {
                let item = $('.product-item').first().clone();
                item.find('input, select').val('').trigger('change');
                $('#product-wrapper').append(item);
            });

            $(document).on('click', '.remove-product', function () {
                if ($('.product-item').length > 1) {
                    $(this).closest('.product-item').remove();
                }
            });
        });
    </script>
@endpush