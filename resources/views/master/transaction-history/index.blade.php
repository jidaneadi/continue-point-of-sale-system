@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts By Sahara') }} | {{ $title }}</title>
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{ __('Transaction History') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Master') }}</li>
                    <li class="breadcrumb-item active">{{ __('Transaction History') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-body')
<section>
    <div class="row">
        <div class="mb-5">
            @foreach($transaction as $index => $item)
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <img src="{{ $item->photo ? Storage::url($item->photo) : 'https://via.placeholder.com/80x80' }}"
                                alt="{{ $item->name_product }}"
                                class="img-fluid rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $item->product_name }}</h6>
                            <div class="small text-muted">Tanggal Foto: {{ \Carbon\Carbon::parse($item->schedule)->format('d-m-Y') }} {{ $item->start_time }} - {{ $item->end_time }}</div>
                            <div class="small text-muted">Status Pembayaran: {{ $item->payment_status }}</div>
                            <div class="small text-muted">Metode Pembayaran: {{ $item->payment_method }}</div>
                        </div>
                        <div class="text-end">
                            <div class="mb-2">
                                <p class="text-danger" style="font-weight: bold;">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <p class="mb-0" style="font-weight: bold;">Jumlah :</p>
                                <p class="mb-0" style="font-weight: bold;">
                                    {{ number_format($item->total / $item->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Tanggal Pembayaran:</span>
                        <p id="totalHargaDisplay-{{ $index }}" class="mb-0" style="font-weight: bold;">
                            {{ $item->paid_at }}
                        </p>
                        <span>Total harga:</span>
                        <p id="totalHargaDisplay-{{ $index }}" class="mb-0" style="font-weight: bold;">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
