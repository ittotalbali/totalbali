<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="landingpage">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img class="img-fluid logo" src="{{ asset('assets/images/logo-perusahaan.png') }}" alt="logo-perusahaan">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/#home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/#tentangkami') }}">Tentang Toefl</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('#layanan') }}">Layanan</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/#kontak') }}">Kontak</a>
            </li>
            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <img class="profilMenu" src="{{ asset('img/profil-default.png') }}" alt="Profil User">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu text-center">
                        <img class="profilMenuDropdown" src="{{ asset('img/profil-default.png') }}" alt="Profil User">
                        <a class="dropdown-item  {{ Route::is('user.profile.*') ? 'active' : '' }}"
                            href="{{ route('user.profile.index') }}">Profile</a> <a
                            class="dropdown-item  {{ Route::is('user.paket.*') ? 'active' : '' }}"
                            href="{{ route('user.paket.index') }}">Paket</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
        @if (Auth::check())
        @else
            <div class="form-inline my-2 my-lg-0">
                <a href="{{ route('register') }}"><button class="btn btn-info color my-2 my-sm-0">Register</button></a>
            </div>
        @endif
    </div>
</nav>
