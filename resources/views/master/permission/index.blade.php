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
                <h2 class="content-header-title float-start mb-0">{{ __('Permissions') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                        <li class="breadcrumb-item">{{ __('Manage Account') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ url()->current() }}">{{ __('Permissions') }}</a>
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
                    </div>

                    <div class="card-body">
                        <table id="crudPermission" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Name') }}</th>
                                    <th class="text-center">{{ __('Guard Name') }}</th>
                                    <th class="text-center">{{ __('Users') }}</th>
                                    <th class="text-center">{{ __('Roles') }}</th>
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
        var datatable = $('#crudPermission').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url()->route('permission.data') }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'name', name: 'name' },
                { data: 'guard_name', name: 'guard_name', width: '15%', class: 'text-center' },
                { data: 'users_count', name: 'users_count', width: '5%', class: 'text-center' },
                { data: 'roles_count', name: 'roles_count', width: '5%', class: 'text-center' },
            ]
        });

        datatable.on('draw', function () {
            feather.replace();
        });
    </script>
@endpush