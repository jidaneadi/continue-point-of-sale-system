<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex justify-content-between w-100">
        <ul class="nav navbar-nav align-items-center">
            <li class="nav-item">
                <img src="{{ Storage::url('assets/logo.png') }}" alt="Arts by Sahara Logo" class="navbar-logo img-fluid">
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/galery') }}" class="nav-link">Galeri</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/product') }}" class="nav-link">Paket</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/aboutme') }}" class="nav-link">Tentang Kami</a>
            </li>
        </ul>
        <ul class="nav navbar-nav align-items-center">
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a class="align-items-end"> | </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </li>
        </ul>
    </div>
</nav>
