<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <span>Total</span> Bali
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            {{-- <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ Route::is('admin.dashboard.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="codesandbox"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li> --}}

            @can('villa-list')
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ Route::is('admin.villa.search') ? 'active' : '' }}">
                <a href="{{ route('admin.villa.search') }}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Villa Database</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.villa.index') ? 'active' : '' }}">
                <a href="{{ route('admin.villa.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Management Villa</span>
                </a>
            </li>
            
            <li class="nav-item {{ Route::is('admin.villa.genrate') ? 'active' : '' }}">
                <a href="{{ route('admin.villa.generate') }}" class="nav-link">
                    <i class="fas fa-clone"></i>
                    <span class="link-title" style="margin-left:15px;">Generate Rates</span>
                </a>
            </li>
            
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#villa" role="button"
                    aria-expanded="{{ Route::is('admin.villas.*') ? 'true' : 'false' }}"
                    aria-controls="villa">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Management Villa</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.villas.index') || Route::is('admin.villas.search') ? 'show' : '' }}"
                    id="villa">
                    <ul class="nav sub-menu">
                        <li class="nav-item {{ Route::is('admin.villas.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.villa.index') }}"
                                class="nav-link {{ Route::is('admin.villas.index') ? 'active' : '' }}">Villa</a>
                        </li>
                        <li class="nav-item {{ Route::is('admin.villas.search') || Route::is('admin.villas.villa-by-location') ? 'active' : '' }}">
                            <a href="{{ route('admin.villa.search') }}"
                                class="nav-link {{ Route::is('admin.villas.search') || Route::is('admin.villas.villa-by-location') ? 'active' : '' }}">Search</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            @endcan
            
            @can('role-list')
                <li class="nav-item nav-category">Data Master</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#country" role="button"
                        aria-expanded="{{ Route::is('admin.countrie.*') || Route::is('admin.area.*') || Route::is('admin.location.*') || Route::is('admin.sub_location.*') ? 'true' : 'false' }}"
                        aria-controls="country">
                        <i class="link-icon" data-feather="map-pin"></i>
                        <span class="link-title">Manajemen Location</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ Route::is('admin.countries.*') || Route::is('admin.area.*') || Route::is('admin.location.*') || Route::is('admin.sub_location.*') ? 'show' : '' }}"
                        id="country">
                        <ul class="nav sub-menu">
                            <li class="nav-item {{ Route::is('admin.countries.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.countries.index') }}"
                                    class="nav-link {{ Route::is('admin.countries.*') ? 'active' : '' }}">Countries</a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.area.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.area.index') }}"
                                    class="nav-link {{ Route::is('admin.area.*') ? 'active' : '' }}">Area</a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.location.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.location.index') }}"
                                    class="nav-link {{ Route::is('admin.location.*') ? 'active' : '' }}">Location</a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.sub_location.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.sub_location.index') }}"
                                    class="nav-link {{ Route::is('admin.sub_location.*') ? 'active' : '' }}">Sub Location</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            <li class="nav-item {{ Route::is('admin.service.*') ? 'active' : '' }}">
                <a href="{{ route('admin.service.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="coffee"></i>
                    <span class="link-title">Service</span>
                </a>
            </li>
            @can('faciliti-list')
                <li class="nav-item {{ Route::is('admin.faciliti.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.faciliti.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="image"></i>
                        <span class="link-title">Facility</span>
                    </a>
                </li>
            @endcan
            {{-- @can('booking-list')
                <li class="nav-item {{ Route::is('admin.booking.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.booking.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="archive"></i>
                        <span class="link-title">Booking</span>
                    </a>
                </li>
            @endcan --}}
            
            
            <!--start rino-->
            <?php
            $activeMenu = Request::segment(2);
            $activeMenux = Request::segment(3);
            ?>
            <li class="nav-item <?php if ($activeMenu == 'currency' && $activeMenux == '') { echo 'active'; } ?>">
                <a href="{{ route('admin.currency.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Currency</span>
                </a>
            </li>
            <li class="nav-item <?php if ($activeMenu == 'currency' && $activeMenux == 'kurs') { echo 'active'; } ?>">
                <a href="{{ route('admin.currency.kurs') }}" class="nav-link">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Currency Conversion</span>
                </a>
            </li>
<!--end rino-->


            <li class="nav-item {{ Route::is('admin.album-category.*') ? 'active' : '' }}">
                <a href="{{ route('admin.album-category.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">Album Category</span>
                </a>
            </li>
            <li class="nav-item nav-category">Account</li>
            @can('user-list')
                <li class="nav-item {{ Route::is('admin.user.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Users</span>
                    </a>
                </li>
            @endcan
            @can('role-list')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#role" role="button"
                        aria-expanded="{{ Route::is('admin.role.*') || Route::is('admin.permission.*') ? 'true' : 'false' }}"
                        aria-controls="role">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Management Users</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ Route::is('admin.role.*') || Route::is('admin.permission.*') ? 'show' : '' }}"
                        id="role">
                        <ul class="nav sub-menu">
                           
                            <li class="nav-item {{ Route::is('admin.role.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.role.index') }}"
                                    class="nav-link {{ Route::is('admin.role.*') ? 'active' : '' }}">Roles</a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.permission.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.permission.index') }}"
                                    class="nav-link {{ Route::is('admin.permission.*') ? 'active' : '' }}">Permission</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>
</nav>
