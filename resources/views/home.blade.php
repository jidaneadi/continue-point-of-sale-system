@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection

@section('content-header')
<!-- <div class="w-100">
    <img src="{{ Storage::url('assets/image_home.png') }}" alt="Home Image"
         class="img-fluid w-100"
         style="height: 500px; object-fit: cover;">
</div> -->
@endsection


@section('content-body')
<section>
    <div class="row">
        <div class="w-100 position-relative" style="height: 500px; overflow: hidden;">
            <img src="{{ Storage::url('assets/image_home.png') }}" alt="Home Image"
                class="img-fluid w-100 h-100"
                style="object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">

            <div class="position-absolute top-50 start-0 translate-middle-y p-4" style="z-index: 2;">
                <h2 style="color: #726161;font-weight: bold;">Welcome to</h2>
                <h1 style="color: #C64444;font-weight: bold;">
                    Arts By Sahara
                </h1>
                <p style="color: #726161">Abadikan momen terbaikmu bersama kami.</p>
                <a href="{{ url('/galery') }}"
                    class="btn text-white border-0"
                    style="
                            background: linear-gradient(to right, #C64444, #602121);
                            padding: 10px 20px;
                    ">
                    Galery kami
                </a>
            </div>

        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
