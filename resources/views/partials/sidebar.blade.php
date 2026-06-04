<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="logo-main">
                <div class="logo-normal">
                    <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 0.757324 19.2427)" fill="currentColor" />
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                    </svg>
                </div>
            </div>
        </a>
        <h4 class="logo-title">TB JWP</h4>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item static-item">
                    <span class="default-icon">Menu Utama</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}" href="{{ route('inventory.index') }}">
                        <span class="item-name">Persediaan Barang</span>
                    </a>
                </li>
                
                @php
                    $masterActive = request()->routeIs('master-data.kategori-barang.*') || 
                                    request()->routeIs('master-data.daftar-barang.*') || 
                                    request()->routeIs('master-data.manajemen-pengguna.*');
                @endphp
                
                <li class="nav-item">
                    <a class="nav-link {{ $masterActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#master-data" role="button" aria-expanded="{{ $masterActive ? 'true' : 'false' }}">
                        <span class="item-name">Master Data</span>
                    </a>
                    <ul class="sub-nav collapse {{ $masterActive ? 'show' : '' }}" id="master-data" data-bs-parent="#sidebar-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-data.kategori-barang.*') ? 'active' : '' }}" href="{{ route('master-data.kategori-barang.index') }}">
                                <span class="item-name">Kategori Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-data.daftar-barang.*') ? 'active' : '' }}" href="{{ route('master-data.daftar-barang.index') }}">
                                <span class="item-name">Daftar Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-data.manajemen-pengguna.*') ? 'active' : '' }}" href="{{ route('master-data.manajemen-pengguna.index') }}">
                                <span class="item-name">Manajemen Pengguna</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                        <span class="item-name">Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>