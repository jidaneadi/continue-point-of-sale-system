@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection

@php

$categorySet = request('category');
$orderingSet = request('order');

$selectCategory = $kategories->where('id', $categorySet)->first()->name ?? 'Filter';
$selectOrder = match($orderingSet){
'termurah' => 'Termurah',
'termahal' => 'Termahal',
'kategori' => 'Kategori',
default => 'Sort By'
}
@endphp

@section('content-body')
<section>
    <div class="row p-2">
        <div class="d-flex align-items-center justify-content-between flex-nowrap my-2" style="gap: 1rem; flex-wrap: nowrap;">
            <h4 class="mb-0 flex-shrink-0 font-bold-brown">Etalase Produk</h4>
            <div class="d-flex gap-2 flex-shrink-0">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="filter" class="me-1"></i> {{ $selectCategory }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => null]) }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach($kategories as $kategori)
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => $kategori->id]) }}">
                                {{ $kategori->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="arrow-down" class="me-1"></i> {{ $selectOrder }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'kategori']) }}">Kategori</a></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'termurah']) }}">Termurah</a></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'termahal']) }}">Termahal</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-felx justify-content-around">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach($products as $product)
                <div class="col-6 col-md-3 mb-2">
                    <div class="card" style="max-width: 250px; max-height: 100%;">
                        <div class="ratio ratio-4x3">
                            <img
                                src="{{ $product->photo ? Storage::url($product->photo) : 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top object-fit-cover"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-bold-red">{{ $product->name }}</h5>
                            <!-- <p class="card-text">{{ \Str::limit($product->description, 100) }}</p> -->
                            <p class="card-text font-bold-brown">Rp. {{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                               <a href="{{ url('/master/list') }}"
                                    class="btn btn-grad flex-fill text-center">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
