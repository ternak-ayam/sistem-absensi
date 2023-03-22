<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">Laravel</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">LVL</a>
    </div>
    <ul class="sidebar-menu">
        <li {{ is_nav_active('dashboard') }}>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        @can('admin')
        <li {{ is_nav_active('user') }}>
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fas fa-users"></i> <span>Users</span>
            </a>
        </li>
        @endcan
        <li class="dropdown {{ is_drop_active('barang') }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-box"></i> <span>Barang</span>
            </a>
            <ul class="dropdown-menu">
                <li {{ is_nav_active('masuk') }}>
                    <a class="nav-link" href="{{ route('admin.barang.masuk.index') }}">
                        <i class="far fa-circle"></i> Barang Masuk
                    </a>
                </li>
                <li {{ is_nav_active('keluar') }}>
                    <a class="nav-link" href="{{ route('admin.barang.keluar.index') }}">
                        <i class="far fa-circle"></i> Barang Keluar
                    </a>
                </li>
                <li {{ is_nav_active('kelola') }}>
                    <a class="nav-link" href="{{ route('admin.barang.index') }}">
                        <i class="far fa-circle"></i> Kelola Barang
                    </a>
                </li>
                <li {{ is_nav_active('laporan') }}>
                    <a class="nav-link" href="{{ route('admin.barang.laporan.index') }}">
                        <i class="far fa-circle"></i> Laporan Barang
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
