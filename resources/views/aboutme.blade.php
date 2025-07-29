@extends('layouts.main')

@section('title')
<title>{{ config('app.name', 'Arts by Sahara') }}</title>
@endsection


@section('content-body')
<section>
    <div class="row">
        <div class="w-100 aboutme-section">
            <img src="{{ Storage::url('assets/image_aboutme.jpg') }}" alt="Home Image">
            <div class="aboutme-content">
                <h2 class="pb-2">Arts by SAHARA Studio Photography</h2>
                <p>Mengabadikan Momen Berharga Anda dengan Sentuhan Professional.</p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items center p-5">
            <h5 class="font-bold-brown text-center pb-3">Tentang Arts By SAHARA</h5>
            <p class="text-justify px-5 mx-4">Arts by SAHARA hadir sebagai solusi untuk mengabadikan setiap momen indah dalam hidup Anda. Kami adalah penyedia jasa fotografi dan rental studio yang berdedikasi untuk menciptakan pengalaman terbaik dalam setiap bidikan.
                Dengan dukungan tim profesional dan peralatan modern, kami siap membantu Anda menangkap keindahan momen-momen spesial, mulai dari sesi potret pribadi, keluarga, hingga acara besar seperti pernikahan atau perayaan lainnya.
                Selain itu, studio kami dirancang khusus untuk memberikan kenyamanan dan fleksibilitas bagi setiap kebutuhan pemotretan Anda.</p>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
