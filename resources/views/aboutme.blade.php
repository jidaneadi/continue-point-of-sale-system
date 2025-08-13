@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection


@section('content-body')
<section>
    <div class="row" style="overflow-x: hidden;">
        <div class="w-100 aboutme-section">
            <img src="{{ Storage::url('assets/image_aboutme.jpg') }}" alt="Home Image">
            <div class="aboutme-content">
                <h2 class="pb-2">Arts by SAHARA Studio Photography</h2>
                <p>Mengabadikan Momen Berharga Anda dengan Sentuhan Professional.</p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center pt-5 pb-0 px-5">
            <h1 class="font-bold-brown text-center pb-2">Tentang Arts By SAHARA</h1>
            <p class="text-justify px-5 mx-4">Arts by SAHARA hadir sebagai solusi untuk mengabadikan setiap momen indah dalam hidup Anda. Kami adalah penyedia jasa fotografi dan rental studio yang berdedikasi untuk menciptakan pengalaman terbaik dalam setiap bidikan.
                Dengan dukungan tim profesional dan peralatan modern, kami siap membantu Anda menangkap keindahan momen-momen spesial, mulai dari sesi potret pribadi, keluarga, hingga acara besar seperti pernikahan atau perayaan lainnya.
                Selain itu, studio kami dirancang khusus untuk memberikan kenyamanan dan fleksibilitas bagi setiap kebutuhan pemotretan Anda.</p>
        </div>
        <div class="row min-vh-100 align-items-center pt-0 px-5">
            <div class="col-md-6">
                <img src="{{ Storage::url('assets/depan.png') }}" alt="Aboutme Image" sizes="" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-start justify-content-center text-start px-4">
                <h1 class="font-bold-brown ">Visi & Misi</h1>
                <p class="text-justify">Visi kami adalah menjadi studio fotografi yang menghadirkan keindahan dalam setiap jepretan, dengan isi memberikan pengalaman fotografi terbaik dan hasil yang memuaskan bagi setiap konsumen. </p>
                <p class="ps-2">
                    Mengutamakan kualita dan kepuasan konsumen
                </p>
                <ul class="list-unstyle">
                    <li><i data-feather="check-circle" class="me-2 align-middle icon"></i>Inovasi berkelanjutan dalam teknik fotografi</li>
                    <li><i data-feather="check-circle" class="me-2 align-middle icon"></i>Pengembangan tim professional dan berkualitas</li>
                </ul>
            </div>
        </div>
        <div>
            <h1 class="font-bold-brown text-center pb-2">Layanan Kami</h1>
            <div class="row row-cols-6 row-cols-sm-3 p-1 justify-content-center text-center">
                <div class="col-6 col-sm-3">
                    <div class="icon-photos">
                        <i data-feather="heart"></i>
                    </div>
                    <p class="font-bold-brown pt-2">Wedding Photography</p>
                    <p class="font-brown">Mengabadikan momen spesial pernikahan Anda</p>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="icon-photos">
                        <i data-feather="shopping-bag"></i>
                    </div>
                    <p class="font-bold-brown pt-2">Product Photography</p>
                    <p class="font-brown">Foto produk professional untuk bisnis Anda</p>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="icon-photos">
                        <i data-feather="users"></i>
                    </div>
                    <p class="font-bold-brown pt-2">Family Potrait</p>
                    <p class="font-brown">Kenangan indah bersama keluarga</p>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="icon-photos">
                        <i data-feather="film"></i>
                    </div>
                    <p class="font-bold-brown pt-2">Studio Rental</p>
                    <p class="font-brown">Kembangkan kreatifitas hasil foto Anda</p>
                </div>
            </div>
        </div>
        <div class="py-5">
            <h1 class="font-bold-brown text-center pb-2">Mengapa Memilih Kami</h1>
            <div class="row row-cols-1 row-cols-md-3 g-3 p-1 justify-content-center align-items-stretch text-start">
                <div class="col">
                    <div class="card card-reason h-75 p-1">
                        <div class="card-body d-flex flex-column">
                            <i data-feather="user-check" class="mb-2"></i>
                            <h4 class="font-bold-brown">Tim Berpengalaman</h4>
                            <p class="font-brown text-justify">Fotografer kami adalah profesional berpengalaman yang memahami seni menangkap momen.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-reason h-75 p-1">
                        <div class="card-body d-flex flex-column">
                            <i data-feather="dollar-sign" class="mb-2"></i>
                            <h4 class="font-bold-brown">Harga Terjangkau</h4>
                            <p class="font-brown text-justify">Kami menawarkan layanan premium dengan harga yang bersahabat.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-reason h-75 p-1">
                        <div class="card-body d-flex flex-column">
                            <i data-feather="check-circle" class="mb-2"></i>
                            <h4 class="font-bold-brown">Pelayanan Ramah</h4>
                            <p class="font-brown text-justify">Kepuasan pelanggan adalah prioritas utama kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 mb-5">
            <h1 class="font-bold-brown text-center pb-2">Siap mengabadikan momen Anda?</h1>
            <div class="d-flex justify-content-center align-items-center pt-1 mb-5">
                <a href="{{ url('/login') }}" class="btn btn-grad">Pesan Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
