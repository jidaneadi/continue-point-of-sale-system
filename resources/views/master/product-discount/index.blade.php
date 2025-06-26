@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
@endsection

@push('css')
    
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Discounts') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ url()->current() }}">{{ __('Discounts') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Data') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ $title }}</h4>

                        <a class="btn btn-outline-primary" href="{{ url()->route('discount.create') }}">
                            <i data-feather="plus"></i>
                            <span>{{ __('Create') }}</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="crudProduct" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Product') }}</th>
                                    <th class="text-center">{{ __('Discount') }}</th>
                                    <th class="text-center">{{ __('Start Date') }}</th>
                                    <th class="text-center">{{ __('End Date') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        var datatable = $('#crudProduct').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url()->route('discount.data') }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'product.name', name: 'product.name' },
                { data: 'discount', name: 'discount', width: '5%', class: 'text-center' },
                { data: 'start_date', name: 'start_date', class: 'text-center' },
                { data: 'end_date', name: 'end_date', class: 'text-center' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    width: '5%',
                    class: 'text-center',
                    render: function(data, type, row) {
                        var editUrl = "{{ route('discount.edit', ':id') }}".replace(':id', row.id);
                        var deleteUrl = "{{ route('discount.destroy', ':id') }}".replace(':id', row.id);
                        
                        return `
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle py-0" data-bs-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="${editUrl}">
                                        <i data-feather="edit-2" class="me-50"></i>
                                        <span>{{ __('Edit') }}</span>
                                    </a>

                                    <a class="dropdown-item" href="${deleteUrl}" data-confirm-delete="true">
                                        <i data-feather="trash" class="me-50"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        });

        datatable.on('draw', function () {
            feather.replace();
        });
    </script>
@endpush