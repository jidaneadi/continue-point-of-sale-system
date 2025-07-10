@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
<style>
    .counter-wrapper {
        display: flex;
        align-items: center;
        gap: 5px;
        max-width: 150px;
    }

    .counter-input {
        width: 50px;
        text-align: center;
    }
</style>
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{ __('Products List') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Master') }}</li>
                    <li class="breadcrumb-item active">{{ __('Detail') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-body')
<section>
    <div class="row my-1">
        <div class="col-12 col-sm-5">
            <img src="{{ Storage::url($data->photo) }}" alt="{{ $data->name }}" class="img-fluid" style="height: 420px; width: 100%; object-fit: cover;" />
        </div>

        <div class="col-12 col-sm-7 px-sm-4">
            <form id="productForm" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $data->id }}">
                <input type="hidden" name="photo_session_id" id="inputSessionId">
                <input type="hidden" name="quantity" id="quantityValue" value="1">
                <input type="hidden" name="photo_date" id="photoDateValue">

                <h2>{{ $data->name }}</h2>
                <h4>{{ $data->price }}</h4>

                <div class="row">
                    <div class="col-7">
                        <label class="form-label">{{ __('Pilih Tanggal*') }}</label>
                        <input type="date" name="photo_date_display" class="form-control" required>
                    </div>
                    <div class="col-5">
                        <label class="form-label">{{ __('Jumlah*') }}</label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-outline-secondary" id="minusBtn">-</button>
                            <input type="text" class="form-control text-center mx-1" id="counterValue" value="1" readonly>
                            <button type="button" class="btn btn-outline-secondary" id="plusBtn">+</button>
                        </div>
                    </div>
                </div>

                <label for="sesiFoto" class="form-label mt-2">Sesi Foto</label>
                <div class="row">
                    @foreach ($sessionPhoto as $sesi)
                    <div class="col-3">
                        <a href="#" class="btn btn-outline-primary ml-1 my-1 sesi-btn" data-time="{{ $sesi->start_time }}" data-id="{{ $sesi->id }}">
                            {{ $sesi->start_time }}
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="row mb-1 mt-2">
                    <label class="col-sm-6 form-label">{{ __('Pilih Pembayaran* :') }}</label>
                    <div class="col-sm-6">
                        <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Payment Method</option>
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
            </form>

            {{-- Tombol di luar form --}}
            <div class="mt-2 d-flex gap-2">
                <button type="button" class="btn btn-primary" id="btnPesan">Pesan Sekarang</button>
                <button type="button" class="btn btn-secondary" id="btnKeranjang">Keranjang</button>
            </div>
        </div>

        <div class="col-12 my-2">
            <h2>Detail Paket</h2>
            <p>{{ $data->description }}</p>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const counterInput = document.getElementById("counterValue");
        const quantityInput = document.getElementById("quantityValue");
        const minusBtn = document.getElementById("minusBtn");
        const plusBtn = document.getElementById("plusBtn");
        const photoDateInput = document.querySelector('input[name="photo_date_display"]');
        const photoDateHidden = document.getElementById("photoDateValue");
        const inputSessionId = document.getElementById("inputSessionId");
        const sesiButtons = document.querySelectorAll('.sesi-btn');
        const form = document.getElementById("productForm");
        const btnPesan = document.getElementById("btnPesan");
        const btnKeranjang = document.getElementById("btnKeranjang");

        // counter
        minusBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let value = parseInt(counterInput.value) || 1;
            if (value > 1) {
                counterInput.value = value - 1;
                quantityInput.value = value - 1;
            }
        });

        plusBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let value = parseInt(counterInput.value) || 1;
            counterInput.value = value + 1;
            quantityInput.value = value + 1;
        });

        sesiButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                sesiButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                inputSessionId.value = this.dataset.id;
            });
        });

        photoDateInput.addEventListener("change", function () {
            photoDateHidden.value = this.value;
        });

        function syncFormData() {
            quantityInput.value = counterInput.value;
            photoDateHidden.value = photoDateInput.value;
        }

        btnPesan.addEventListener("click", function () {
            syncFormData();
            form.action = "{{ route('list.store_detail') }}";
            form.submit();
        });

        btnKeranjang.addEventListener("click", function () {
            syncFormData();
            form.action = "{{ route('list.store_bucket') }}";
            form.submit();
        });
    });
</script>
@endpush
