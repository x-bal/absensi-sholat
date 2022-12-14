<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }} w-100">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Menu</span>
        </p>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item {{ request()->is('users*') || request()->is('jurusan*') || request()->is('angkatan*') || request()->is('jadwal*') || request()->is('siswa*') ? 'active' : '' }} dropdown">
                <a href="#data-master" data-toggle="collapse" aria-expanded="{{ request()->is('users*') || request()->is('jurusan*') || request()->is('angkatan*') || request()->is('jadwal*') || request()->is('siswa*') ? 'true' : '' }}" class="dropdown-toggle nav-link">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Data Master</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 {{ request()->is('users*') || request()->is('jurusan*') || request()->is('angkatan*') || request()->is('jadwal*') || request()->is('siswa*') ? 'show' : '' }}" id="data-master">
                    @can('isAdmin')
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('users.index') }}"><span class="ml-1 item-text">Data User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('jurusan.index') }}"><span class="ml-1 item-text">Data Jurusan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('angkatan.index') }}"><span class="ml-1 item-text">Data Angkatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('jadwal.index') }}"><span class="ml-1 item-text">Data Jadwal</span>
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('siswa.index') }}"><span class="ml-1 item-text">Data Siswa</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item {{ request()->is('device*') || request()->is('rfid*') || request()->is('history*') ? 'active' : '' }} dropdown">
                <a href="#data-devices" data-toggle="collapse" aria-expanded="{{ request()->is('device*') || request()->is('rfid*') || request()->is('history*') ? 'true' : '' }}" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Data Devices</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 {{ request()->is('device*') || request()->is('rfid*') || request()->is('history*') ? 'show' : '' }}" id="data-devices">
                    @can('isAdmin')
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('device.index') }}"><span class="ml-1 item-text">Data Device</span>
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('rfid.index') }}"><span class="ml-1 item-text">Data Rfid</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('history.index') }}"><span class="ml-1 item-text">History Device</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item {{ request()->is('absensi*') ? 'active' : '' }} dropdown">
                <a href="#data-absensi" data-toggle="collapse" aria-expanded="{{ request()->is('absensi*') ? 'true' : '' }}" class="dropdown-toggle nav-link">
                    <i class="fe fe-list fe-16"></i>
                    <span class="ml-3 item-text">Data Absensi</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 {{ request()->is('absensi*') ? 'show' : '' }}" id="data-absensi">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('absensi.index') }}"><span class="ml-1 item-text">Absensi Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('absensi.rekap') }}"><span class="ml-1 item-text">Rekap Absensi</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>
</aside>