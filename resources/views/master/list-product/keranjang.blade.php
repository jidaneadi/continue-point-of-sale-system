@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{ __('Products List') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Master') }}</li>
                    <li class="breadcrumb-item active">{{ __('Keranjang') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-body')
<section>
    <div class="row">
        <div class="mb-2">
            <input type="checkbox" id="selectAll" class="form-check-input me-1">
            <label for="selectAll">Pilih Semua</label>
        </div>
        <div class="mb-5">
            @foreach($keranjang as $index => $item)
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <input type="checkbox" class="form-check-input item-checkbox"
                                data-index="{{ $index }}"
                                data-price="{{ $item->price }}">
                        </div>
                        <div class="me-3">
                            <img src="{{ $item->photo ? Storage::url($item->photo) : 'https://via.placeholder.com/80x80' }}"
                                alt="{{ $item->name_product }}"
                                class="img-fluid rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $item->name_product }}</h6>
                            <div class="small text-muted">Tanggal Foto: {{ $item->schedule }}</div>
                            <div class="small text-muted">Sesi Foto: {{ $item->start }} - {{ $item->end }}</div>
                        </div>
                        <div class="text-end">
                            <div class="mb-2">
                                <p class="text-danger" style="font-weight: bold;">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="input-group input-group-sm jumlah-wrapper"
                                data-price="{{ $item->price }}"
                                data-index="{{ $index }}"
                                style="width: 120px;">
                                <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                                <input type="text" class="form-control text-center input-jumlah" value="{{ $item->jumlah }}" readonly>
                                <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Total harga:</span>
                        <p id="totalHargaDisplay-{{ $index }}" class="mb-0" style="font-weight: bold;">
                            Rp {{ number_format($item->price * $item->jumlah, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="bg-white shadow-lg border-top py-3 position-fixed bottom-0 start-0 w-100" style="z-index: 1000;">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <strong>Total (<span id="totalProduk">0</span> produk):</strong>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <strong id="grandTotal" class="fs-5">Rp0</strong>
                    <button class="btn btn-danger">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const jumlahWrappers = document.querySelectorAll('.jumlah-wrapper');
        const totalProdukEl = document.getElementById('totalProduk');
        const grandTotalEl = document.getElementById('grandTotal');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const selectAll = document.getElementById('selectAll');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function updateSemuaTotal() {
            let totalHarga = 0;
            let totalProduk = 0;

            itemCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    const index = checkbox.dataset.index;
                    const price = parseInt(checkbox.dataset.price);
                    const jumlahInput = document.querySelector(`.jumlah-wrapper[data-index="${index}"] .input-jumlah`);
                    const jumlah = parseInt(jumlahInput.value) || 1;

                    totalProduk += jumlah;
                    totalHarga += jumlah * price;
                }
            });

            totalProdukEl.textContent = totalProduk;
            grandTotalEl.textContent = formatRupiah(totalHarga);
        }

        jumlahWrappers.forEach(function(wrapper) {
            const minusBtn = wrapper.querySelector('.btn-minus');
            const plusBtn = wrapper.querySelector('.btn-plus');
            const inputJumlah = wrapper.querySelector('.input-jumlah');
            const price = parseInt(wrapper.dataset.price);
            const index = wrapper.dataset.index;
            const totalHargaEl = document.getElementById(`totalHargaDisplay-${index}`);

            function updateCardTotal() {
                const jumlah = parseInt(inputJumlah.value) || 1;
                totalHargaEl.textContent = `${formatRupiah(price)} x ${jumlah} = ${formatRupiah(jumlah * price)}`;
                updateSemuaTotal();
            }

            minusBtn.addEventListener("click", function() {
                let val = parseInt(inputJumlah.value) || 1;
                if (val > 1) {
                    inputJumlah.value = val - 1;
                    updateCardTotal();
                }
            });

            plusBtn.addEventListener("click", function() {
                let val = parseInt(inputJumlah.value) || 1;
                inputJumlah.value = val + 1;
                updateCardTotal();
            });

            updateCardTotal();
        });

        itemCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                updateSemuaTotal();
                if (!checkbox.checked) {
                    selectAll.checked = false;
                } else {
                    const allChecked = [...itemCheckboxes].every(cb => cb.checked);
                    selectAll.checked = allChecked;
                }
            });
        });


        selectAll.addEventListener("change", function() {
            itemCheckboxes.forEach(function(cb) {
                cb.checked = selectAll.checked;
            });
            updateSemuaTotal();
        });

        updateSemuaTotal();
    });
</script>
@endpush
