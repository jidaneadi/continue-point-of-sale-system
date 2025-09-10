@extends('layouts.master')

@section('title')
<title>{{ config('app.name', 'Arts By Sahara') }} | {{ $title }}</title>
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title font-bold-brown float-start mb-0">{{ __('Transaction History') }}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item font-brown">{{ __('Master') }}</li>
                    <li class="breadcrumb-item font-brown">{{ __('Transaction History') }}</li>
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
            @php
            $detailTransactions = $item->details->first();
            @endphp
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <img src="{{ $detailTransactions?->product?->photo ? Storage::url($detailTransactions->product->photo) : 'https://via.placeholder.com/80x80' }}"
                                alt="{{ $detailTransactions?->product?->name }}"
                                class="img-fluid rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 font-bold-red">{{ $item->id }}</h6>
                            <div class="small text-muted">
                                Tanggal Foto:
                                {{ $detailTransactions?->schedule ? \Carbon\Carbon::parse($detailTransactions->schedule)->format('d-m-Y') : '-' }}
                                {{ $detailTransactions?->photoSession?->start_time ?? '-' }} - {{ $detailTransactions?->photoSession?->end_time ?? '-' }}
                            </div>
                            <div class="small text-muted">Status Pembayaran: {{ $item->payment_status }}</div>
                            <div class="small text-muted">Metode Pembayaran: {{ $item->payment_method }}</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-sm btn-grad" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $index }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="font-brown">Tanggal Pembayaran:</span>
                        <p id="totalHargaDisplay-{{ $index }}" class="mb-0 font-bold-brown">
                            {{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('d-m-Y H:i') : '-' }}
                        </p>
                        <span class="font-brown">Total harga:</span>
                        <p id="totalHargaDisplay-{{ $index }}" class="mb-0 font-bold-brown">
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="detailModal-{{ $index }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-bold-brown" id="detailModalLabel-{{ $index }}">Detail Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach($item->details as $detail)
                            <div class="d-flex mb-3 p-2 border rounded">
                                <div class="me-3">
                                    <img src="{{ $detail->product->photo ? Storage::url($detail->product->photo) : 'https://via.placeholder.com/60x60' }}"
                                        alt="{{ $detail->product->name }}"
                                        class="img-fluid rounded"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 font-bold-red">{{ $detail->product->name }}</h6>
                                    <div class="small text-muted">Waktu: {{ $detail->photoSession->start_time }} - {{ $detail->photoSession->end_time }}</div>
                                    <div class="small text-muted">Fotografer: {{ $detail->photographer->user->name ?? '-' }}</div>
                                    <div class="small text-muted">Harga: Rp {{ number_format($detail->price, 0, ',', '.') }}</div>
                                    <div class="small text-muted">Jumlah: {{ number_format($detail->total / $detail->price, 0, ',', '.') }}</div>
                                </div>
                                <div>
                                    <span class="font-brown">Total harga:</span>
                                    <p class="font-bold-brown mb-0">
                                        Rp {{ number_format($detail->price * ($detail->total / $detail->price), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-brown" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
@endsection
