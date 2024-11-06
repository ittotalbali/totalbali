<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->image != 'profile.png')
                        <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Foto_Profil"
                            class="rounded-circle coba mb-2" width="50%" height="100px">
                    @else
                        <img src="{{ asset('img/icon.png') }}" alt="profile">
                        {{-- <i class="fas fa-user-circle" style="font-size: 100px;"></i> --}}
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            @if (Auth::user()->image != 'profile.png')
                                <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Foto_Profil"
                                    class="rounded-circle coba mb-2" width="50%" height="100px">
                            @else
                                <img src="{{ asset('img/icon.png') }}" alt="profile">
                                {{-- <i class="fas fa-user-circle" style="font-size: 100px;"></i> --}}
                            @endif
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{ Auth::user()->name }}</p>
                            <p class="email text-muted mb-3">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ url('admin/user/' . Auth::user()->id . '/edit') }}" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('logout') }}" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
