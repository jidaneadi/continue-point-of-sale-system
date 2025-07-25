@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{ __('About Me') }}</h2>
            <!-- <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Master') }}</li>
                    <li class="breadcrumb-item active">{{ __('Keranjang') }}</li>
                </ol>
            </div> -->
        </div>
    </div>
</div>
@endsection

@section('content-body')
<section>
    <div class="row">
        About Me
    </div>
</section>
@endsection

@push('script')
@endpush
