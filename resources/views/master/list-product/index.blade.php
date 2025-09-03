@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
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

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title font-bold-brown float-start mb-0">{{ __('Products List') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item font-brown">{{ __('Master') }}</li>
                    <li class="breadcrumb-item font-brown">{{ __('Products') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-body')
<section>
    <div class="row">
        <div class="d-flex align-items-center justify-content-between flex-nowrap my-2" style="gap: 1rem; flex-wrap: nowrap;">
            <h4 class="mb-0 font-brown flex-shrink-0">{{ $title }}</h4>
            <div class="d-flex gap-2 flex-shrink-0">
                <div class="dropdown">
                    <button class="btn btn-outline-brown btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="filter" class="me-1 font-brown"></i> {{ $selectCategory }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item font-brown" href="{{ request()->fullUrlWithQuery(['category' => null]) }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach($kategories as $kategori)
                        <li>
                            <a class="dropdown-item font-brown" href="{{ request()->fullUrlWithQuery(['category' => $kategori->id]) }}">
                                {{ $kategori->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-brown btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="arrow-down" class="me-1 font-brown"></i> {{ $selectOrder }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item font-brown" href="{{ request()->fullUrlWithQuery(['order' => 'kategori']) }}">Kategori</a></li>
                        <li><a class="dropdown-item font-brown" href="{{ request()->fullUrlWithQuery(['order' => 'termurah']) }}">Termurah</a></li>
                        <li><a class="dropdown-item font-brown" href="{{ request()->fullUrlWithQuery(['order' => 'termahal']) }}">Termahal</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-felx justify-content-around">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach($products as $product)
                <div class="col-6 col-md-3 mb-2">
                    <div class="card" style="max-width: 250px; height: 100%;">
                        <div class="ratio ratio-4x3">
                            <img
                                src="{{ $product->photo ? Storage::url($product->photo) : 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top object-fit-cover"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-bold-red" style="font-weight: bold;">{{ $product->name }}</h5>
                            <p class="card-text">{{ \Str::limit($product->description, 100) }}</p>
                            <p class="card-text font-bold-brown">Rp. {{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                                <a href="{{ url('/master/list/detail/' . $product->id) }}"
                                    class="btn btn-grad-grey text-white btn-sm flex-fill text-center">
                                    Detail
                                </a>
                                <a class="btn btn-grad btn-sm flex-fill text-center text-white btn-keranjang"
                                    data-bs-toggle="modal"
                                    data-bs-target="#keranjangModal"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}">
                                    <i data-feather="shopping-cart"></i> Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 font-bold-brown" id="modalProductName">Produk Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('list.store_bucket') }}">
                        @csrf
                        <input type="hidden" name="product_id" id="inputProductId">
                        <input type="hidden" name="photo_session_id" id="inputSessionId">
                        <input type="hidden" name="photographer_id" value="">

                        <div class="row">
                            <div class="col-7">
                                <label class="form-label font-brown">{{ __('Pilih Tanggal*') }}</label>
                                <input type="date" name="photo_date" class="form-control form-border-brown" required>
                            </div>
                            @error('photo_date')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <div class="col-5">
                                <label class="form-label font-brown">{{ __('Jumlah*') }}</label>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-brown" id="minusBtn">-</button>
                                    <input type="text" class="form-control form-border-brown text-center mx-1" name="quantity" id="counterValue" value="1" readonly>
                                    <button type="button" class="btn btn-outline-brown" id="plusBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <label class="form-label mt-2 font-brown">{{ __('Sesi Foto*') }}</label>
                        <div class="row">
                            @foreach ($sessionPhoto as $sesi)
                            <div class="col-3">
                                <a href="#" class="btn btn-outline-brown ml-1 my-1 sesi-btn" data-time="{{ $sesi->start_time }}" data-id="{{ $sesi->id }}">
                                    {{ $sesi->start_time }}
                                </a>
                            </div>
                            @endforeach
                            @foreach ($sessionOutdoor as $outdoor)
                            <div class="col-5">
                                <a href="#" class="btn btn-outline-brown ml-1 my-1 sesi-btn" data-time="{{ $outdoor->start_time }}" data-id="{{ $outdoor->id }}">
                                    {{ $outdoor->name }}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <label class="form-label mb-0 font-brown">Total Harga</label>
                            <!-- <p id="hargaProduk" type="hidden" class="text-muted small">Harga: Rp. 0</p> -->
                            <p id="totalHargaDisplay" class="mb-0 font-brown text-end">Rp. 0 x 0 = Rp. 0</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-grey" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-grad"><i data-feather="plus"></i> Masukkan Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (feather) feather.replace();

        const keranjangButtons = document.querySelectorAll('.btn-keranjang');
        const modalProductName = document.getElementById('modalProductName');
        // const hargaProdukEl = document.getElementById('hargaProduk');
        const totalHargaEl = document.getElementById('totalHargaDisplay');
        const counterValue = document.getElementById("counterValue");
        const minusBtn = document.getElementById("minusBtn");
        const plusBtn = document.getElementById("plusBtn");
        const inputProductId = document.getElementById("inputProductId");
        const inputSessionId = document.getElementById("inputSessionId");

        let currentPrice = 0;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2
            }).format(angka);
        }

        function updateTotalHarga() {
            const jumlah = parseInt(counterValue.value) || 1;
            const total = currentPrice * jumlah;
            totalHargaEl.textContent = `${formatRupiah(currentPrice)} x ${jumlah} = ${formatRupiah(total)}`;
        }

        keranjangButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productName = button.getAttribute('data-name');
                currentPrice = parseFloat(button.getAttribute('data-price'));
                const productId = button.getAttribute('data-id');
                inputProductId.value = productId;

                modalProductName.textContent = productName;
                // hargaProdukEl.textContent = formatRupiah(currentPrice);
                counterValue.value = 1;
                updateTotalHarga();
                inputSessionId.value = '';
            });
        });
        minusBtn.addEventListener("click", function(e) {
            e.preventDefault();
            let value = parseInt(counterValue.value) || 1;
            if (value > 1) counterValue.value = value - 1;
            updateTotalHarga();
        });

        plusBtn.addEventListener("click", function(e) {
            e.preventDefault();
            let value = parseInt(counterValue.value) || 1;
            counterValue.value = value + 1;
            updateTotalHarga();
        });

        const sesiButtons = document.querySelectorAll('.sesi-btn');
        sesiButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                sesiButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                const sesiId = this.getAttribute('data-id');
                inputSessionId.value = sesiId;
            });
        });
    });
</script>
@endpush
