<style>
    .navbar-nav .nav-link.active {
        color: #C64444 !important;
        border-bottom: 2px solid #C64444;
    }
</style>

<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex justify-content-between w-100">
        <ul class="nav navbar-nav align-items-center">
            <li class="nav-item">
                <img src="{{ Storage::url('assets/logo.png') }}" alt="Arts by Sahara Logo" class="navbar-logo img-fluid">
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link font-bold-brown {{ request()->is('/') ? 'active' : '' }}">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/galery') }}" class="nav-link font-bold-brown {{ request()->is('galery') ? 'active' : '' }}">Galeri</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/product') }}" class="nav-link font-bold-brown {{ request()->is('product') ? 'active' : '' }}">Paket</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/aboutme') }}" class="nav-link font-bold-brown {{ request()->is('aboutme') ? 'active' : '' }}">Tentang Kami</a>
            </li>
        </ul>
        <ul class="nav navbar-nav align-items-center">
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link font-bold-brown {{ request()->is('login') ? 'active' : '' }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="align-items-end"> | </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link font-bold-brown {{ request()->is('register') ? 'active' : '' }}">Register</a>
            </li>
        </ul>
    </div>
</nav>
