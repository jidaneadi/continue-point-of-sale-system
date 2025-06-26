@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Arts by Sahara') }} | {{ $title }}</title>
@endsection

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ __('Transactions') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Master') }}</li>
                        <li class="breadcrumb-item active">{{ __('Transactions') }}</li>
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

                        <a class="btn btn-outline-primary" href="{{ route('transaction.create') }}">
                            <i data-feather="plus"></i>
                            <span>{{ __('Create') }}</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="crudTransaction" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">Paid At</th>
                                    <th class="text-center">Action</th>
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
        var datatable = $('#crudTransaction').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction.data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', orderable: false, searchable: false },
                { data: 'customer', name: 'customer.user.name', class: 'text-center' },
                { data: 'total_price', name: 'total_price', class: 'text-center' },
                { data: 'payment_status', name: 'payment_status', class: 'text-center' },
                { data: 'payment_method', name: 'payment_method', class: 'text-center' },
                { data: 'paid_at', name: 'paid_at', class: 'text-center' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    width: '5%',
                    class: 'text-center',
                    render: function(data, type, row) {
                        var deleteUrl = "{{ route('transaction.destroy', ':id') }}".replace(':id', row.id);
                        
                        return `
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle py-0" data-bs-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end">
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