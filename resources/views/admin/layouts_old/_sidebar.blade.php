<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center>
                {{-- <div>
                </div> --}}
                {{-- {{(Auth::user()->image)}} --}}
                <div>
                    @if (Auth::user()->image != 'profile.png')
                        <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Foto_Profil"
                            class="rounded-circle coba mb-2" width="50%" height="100px">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 100px;"></i>
                    @endif
                </div>
                <br>
                <span class="text-capitalize">{{ Auth::user()->name }}</span>
                <hr>
            </center>
        </div>

        <ul class="list-unstyled components">
            <li class=" {{ Route::is('admin.dashboard.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-tachometer-alt pr-2"></i> Dashboard</a>
            </li>
            @can('user-list')
                <li class=" {{ Route::is('admin.user.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}"><i class="fas fa-user pr-2"></i> User</a>
                </li>
            @endcan
            {{-- @can('country-list')
                <li class=" {{ Route::is('admin.countrie.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.countrie.index') }}"><i class="fas fa-user pr-2"></i> Countires</a>
                </li>
            @endcan
            @can('area-list')
                <li class=" {{ Route::is('admin.area.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.area.index') }}"><i class="fas fa-user pr-2"></i> Area</a>
                </li>
            @endcan --}}
            @can('role-list')
                <li class=" {{ Route::is('admin.countrie.*') ? 'active' : '' }}">
                    <a href="#country" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i
                            class="fas fa-book pr-2"></i> Manajemen Location </a>
                    <ul class="list-unstyled collapse" id="country">
                        <li>
                            <a href="{{ route('admin.countrie.index') }}"> Countires</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.area.index') }}"> Area</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.location.index') }}"> Location</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sub_location.index') }}"> Sub Location</a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.sub_location.lokasi') }}"> Lokasi</a>
                        </li> --}}
                    </ul>
                </li>
            @endcan
            @can('faciliti-list')
                <li class=" {{ Route::is('admin.faciliti.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.faciliti.index') }}"><i class="fas fa-user pr-2"></i> Facilities</a>
                </li>
            @endcan
            {{-- <li class=" {{ Route::is('admin.facility_villa.*') ? 'active' : '' }}">
                <a href="{{ route('admin.facility_villa.index') }}"><i class="fas fa-user pr-2"></i> Facility Villa</a>
            </li> --}}
            @can('villa-list')
                <li class=" {{ Route::is('admin.villa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.villa.index') }}"><i class="fas fa-user pr-2"></i>Villa</a>
                </li>
            @endcan
            {{-- <li class=" {{ Route::is('admin.rate.*') ? 'active' : '' }}">
                <a href="{{ route('admin.rate.index') }}"><i class="fas fa-user pr-2"></i>Rate</a>
            </li> --}}
            @can('booking-list')
                <li class=" {{ Route::is('admin.booking.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.booking.index') }}"><i class="fas fa-user pr-2"></i>Booking</a>
                </li>
            @endcan
            @can('role-list')
                <li class=" {{ Route::is('admin.role.*') ? 'active' : '' }}">
                    <a href="#role" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i
                            class="fas fa-edit pr-2"></i> Manajemen Role </a>
                    <ul class="list-unstyled collapse" id="role">
                        <li>
                            <a href="{{ route('admin.role.index') }}"> Role</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permission.index') }}"> Permission</a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- <li class="{{ Route::is('admin.quest.*') ? 'active' : '' }}">
                <a href="#posts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i
                        class="fas fa-edit pr-2"></i> Questions </a>
                <ul class="list-unstyled collapse" id="posts">
                    <li>
                        <a href="{{ route('admin.quest.listening') }}"> Listening</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.quest.reading') }}"> Reading</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.quest.structure') }}"> Structure</a>
                    </li>
                </ul>
                <a href="{{ route('admin.quest.index') }}"><i class="fas fa-edit pr-2"></i> Questions</a>
            </li> --}}

            {{-- <li class=" {{ Route::is('admin.answers.*') ? 'active' : '' }}">
                <a href="{{ route('admin.answers.index') }}"><i class="fas fa-file-alt pr-2"></i> Answers</a>
            </li> --}}
            <li class="">
                <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt pr-2"></i> Logout</a>
            </li>
        </ul>
    </nav>
