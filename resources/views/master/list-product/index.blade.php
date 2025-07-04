@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
<style>
    .sesi-btn.active {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
</style>
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
            <h2 class="content-header-title float-start mb-0">{{ __('Products List') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Master') }}</li>
                    <li class="breadcrumb-item active">{{ __('Products') }}</li>
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
            <h4 class="mb-0 flex-shrink-0">{{ $title }}</h4>
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
                    <div class="card" style="max-width: 250px; height: 100%;">
                        <div class="ratio ratio-4x3">
                            <img
                                src="{{ $product->photo ? Storage::url($product->photo) : 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top object-fit-cover"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ \Str::limit($product->description, 100) }}</p>
                            <p class="card-text fw-bold text-primary">Rp. {{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                                <a href="{{ url('/master/list/detail/' . $product->id) }}"
                                    class="btn btn-outline-primary btn-sm flex-fill text-center">
                                    Detail
                                </a>
                                <a class="btn btn-outline-success btn-sm flex-fill text-center btn-keranjang"
                                    data-bs-toggle="modal"
                                    data-bs-target="#keranjangModal"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}">
                                    Pilih Produk
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
                    <h1 class="modal-title fs-5" id="modalProductName">Produk Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('list.store') }}">
                        @csrf
                        <input type="hidden" name="product_id[]" id="inputProductId">
                        <input type="hidden" name="photo_session_id[]" id="inputSessionId">
                        <input type="hidden" name="photographer_id[]" value="">

                        <div class="row">
                            <div class="col-7">
                                <label class="form-label">{{ __('Pilih Tanggal*') }}</label>
                                <input type="date" name="photo_date[]" class="form-control" required>
                            </div>
                            @error('photo_date')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <div class="col-5">
                                <label class="form-label">{{ __('Jumlah*') }}</label>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-secondary" id="minusBtn">-</button>
                                    <input type="text" class="form-control text-center mx-1" name="quantity" id="counterValue" value="1" readonly>
                                    <button type="button" class="btn btn-outline-secondary" id="plusBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <label class="form-label mt-2">{{ __('Sesi Foto*') }}</label>
                        <div class="row">
                            @foreach ($sessionPhoto as $sesi)
                            <div class="col-3">
                                <a href="#" class="btn btn-outline-primary my-1 sesi-btn" data-time="{{ $sesi->start_time }}" data-id="{{ $sesi->id }}">
                                    {{ $sesi->start_time }}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <label class="form-label mb-0">Total Harga</label>
                            <!-- <p id="hargaProduk" type="hidden" class="text-muted small">Harga: Rp. 0</p> -->
                            <p id="totalHargaDisplay" class="mb-0 fw-bold text-end">Rp. 0 x 0 = Rp. 0</p>
                        </div>

                        <div class="row mb-1 mt-2">
                            <label class="col-sm-6 form-label" for="payment_method">{{ __('Pilih Pembayaran* :') }}</label>
                            <div class="col-sm-6">
                                <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                    <option value="" disabled>Select Payment Method</option>
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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
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
