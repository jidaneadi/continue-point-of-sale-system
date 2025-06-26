@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ __('Dashboard') }}</title>
@endsection

@push('css')
    
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Dashboard') }}</h2>
                
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ url()->current() }}">{{ __('Dashboard') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section id="dashboard-analytics">
        <div class="row match-height">
            
        </div>
    </section>
@endsection

@push('script')
    
@endpush