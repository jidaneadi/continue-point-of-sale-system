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
            <form action="{{ route('list.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id[]" value="{{ $data->id }}">
                <input type="hidden" name="photo_session_id[]" id="inputSessionId">
                <input type="hidden" name="photographer_id[]" value="">

                <h2> {{ $data->name }} </h2>
                <h4> {{ $data->price }} </h4>
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
                <label for="sesiFoto" class="form-label mt-2">Sesi Foto</label>
                <div class="row">
                    @foreach ($sessionPhoto as $sesi)
                    <div class="col-3">
                        <a href="#" class="btn btn-outline-primary ml-1 my-1 sesi-btn" data-time="{{ $sesi->start_time }}" data-id="{{ $sesi->id }}"> {{ $sesi->start_time }} </a>
                    </div>
                    @endforeach
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </form>
        </div>
        <div class="col-12 my-2">
            <h2>Detail Paket</h2>
            <p> {{ $data->description }} </p>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const keranjangButtons = document.querySelectorAll('.btn-keranjang');
        const modalProductName = document.getElementById('modalProductName');
        const counterVal = document.getElementById("counterValue");
        const minusBtn = document.getElementById("minusBtn");
        const plusBtn = document.getElementById("plusBtn");
        const inputSessionId = document.getElementById("inputSessionId");

        let currentPrice = 0;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
            }).format(angka);
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
    })
</script>
@endpush
