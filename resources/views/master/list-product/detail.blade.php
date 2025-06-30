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
        <div class="row m-1">
            <div class="col-12 col-sm-4">
                <img src="{{ Storage::url($data->photo) }}" alt="{{ $data->name }}" class="img-fluid" />
            </div>
            <div class="col-12 col-sm-8 px-sm-4">
                <h2> {{ $data->name }} </h2>
                <h4> {{ $data->price }} </h4>
                <div class="row">
                    <div class="col-7">
                        <label for="exampleFormControlInput1" class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>
                    <div class="col-5">
                        <label for="exampleFormControlInput1" class="form-label col-5">Jumlah</label>
                        <div class="d-flex col-12">
                            <button class="btn btn-outline-secondary col-1" id="minusBtn">-</button>
                            <div class="col-3 inline-block">
                                <input type="text" class="form-control counter-input" id="counterValue" value="1" />
                            </div>
                            <button class="btn btn-outline-secondary col-1" id="plusBtn">+</button>
                        </div>
                    </div>
                </div>
                <label for="sesiFoto" class="form-label mt-2">Sesi Foto</label>
                <div class="row">
                    @foreach ($sessionPhoto as $sesi)
                        <div class="col-3">
                            <a class="btn btn-outline-primary ml-1 my-1"> {{ $sesi->start_time }} </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12">
                <h2>Detail Paket</h2>
                <p> {{ $data->description }} </p>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
