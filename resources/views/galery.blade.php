@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }} </title>
@endsection

@section('content-body')
<section>
    <div class="row p-2">
        <h4 class="font-bold-brown">Galeri Foto</h4>
        <h4 class="font-bold-red">Arts By SAHARA</h4>
        <div class="pt-2 ps-0">
            <div class="pt-1">
                <p class="font-brown ps-1">Foto Graduation</p>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 px-1">
                    <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/graduation1.jpg') }}" alt="" srcset="">
                    <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/graduation2.jpg') }}" alt="" srcset="">
                    <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/graduation3.jpg') }}" alt="" srcset="">
                    <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/graduation4.jpg') }}" alt="" srcset="">
                </div>
            </div>
            <div class="pt-4">
                <p class="font-brown ps-1">Foto Group</p>
                <div class="d-flex justify-content-center align-items-center gap-4">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 px-1">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/group.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/group_bronze.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/group_gold.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/group_platinum.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <p class="font-brown ps-1">Foto Prewedding</p>
                <div class="d-flex justify-content-center align-items-center gap-4">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 px-1">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/prewet1.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/prewet2.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/prewed_gold.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/prewed_platinum.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <p class="font-brown ps-1">Foto Wedding</p>
                <div class="d-flex justify-content-center align-items-center gap-4">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 px-1">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/zz.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/wedding_bronze.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/wedding_gold.jpg') }}" alt="" srcset="">
                        <img style="width: 400;height:400;" class="img-fluid" src="{{ Storage::url('assets/galery/wedding_platinum.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
