@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection

@section('content-header')
@endsection


@section('content-body')
<section>
    <div class="row" style="overflow-x: hidden;">
        <div class="w-100 home-section">
            <img src="{{ Storage::url('assets/image_home.png') }}" alt="Home Image">
            <div class="home-content">
                <h2>Welcome to</h2>
                <h1>Arts By SAHARA</h1>
                <p>Abadikan momen terbaikmu bersama kami.</p>
                <a href="{{ url('/galery') }}" class="btn btn-grad">Galery kami</a>
            </div>
        </div>
        <div>
            <div class="d-flex flex-column justify-content-center align-items-center py-4 text-center">
                <div>
                    <h4 class="font-bold-brown pb-0 mb-0">Paket Layanan Kami</h4>
                    <div class="divider pt-0 mt-0"></div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 p-1">
                @foreach($product as $product)
                <div class="col-6 col-md-3">
                    <div class="card" style="max-width: 250px; height: 100%;">
                        <div class="ratio ratio-4x3">
                            <img
                                src="{{ $product->photo ? Storage::url($product->photo) : 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top object-fit-cover"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body p-1">
                            <h5 class="font-bold-red ">{{ $product->name }}</h5>
                            <p class="card-text font-bold-brown">Rp. {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row min-vh-100 align-items-center">
            <div class="col-md-6 d-flex flex-column align-items-start justify-content-center text-center text-md-start px-4">
                <h1 class="font-bold-red mb-3">Arts By SAHARA</h1>
                <p class="mb-3">
                    Arts by Sahara hadir sebagai solusi untuk mengabadikan setiap momen indah dalam hidup Anda. Kami adalah penyedia jasa fotografi dan rental studio
                </p>
                <a href="{{ url('/aboutme') }}" class="btn btn-grad">Selengkapnya</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ Storage::url('assets/lobby.png') }}" alt="Home Image" class="img-fluid img-home">
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
