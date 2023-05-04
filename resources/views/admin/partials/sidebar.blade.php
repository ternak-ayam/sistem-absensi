<aside id="sidebar-wrapper">
    <div class="sidebar-brand mb-5">
        <a href="{{ url('/') }}">
            <img width="120" src="{{ asset('assets/images/logo/pao.png') }}" alt="">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
            <img width="40" src="{{ asset('assets/images/logo/pao.png') }}" alt="">
        </a>
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
                @canany(['admin', 'pegawai', 'owner'])
                    @canany(['admin', 'pegawai'])
                        <li {{ is_nav_active('master') }}>
                            <a class="nav-link" href="{{ route('admin.barang.master.index') }}">
                                <i class="far fa-circle"></i> Master Barang
                            </a>
                        </li>
                        <li {{ is_nav_active('list') }}>
                            <a class="nav-link" href="{{ route('admin.barang.list.index') }}">
                                <i class="far fa-circle"></i> List Barang
                            </a>
                        </li>
                    @endcanany
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
                    @canany(['admin', 'pegawai'])
                        <li {{ is_nav_active('kelola') }}>
                            <a class="nav-link" href="{{ route('admin.barang.index') }}">
                                <i class="far fa-circle"></i> Kelola Barang
                            </a>
                        </li>
                    @endcanany
                    <li {{ is_nav_active('retur') }}>
                        <a class="nav-link" href="{{ route('admin.barang.return.index') }}">
                            <i class="far fa-circle"></i> Retur Barang
                        </a>
                    </li>
                @endcanany
            </ul>
        </li>
        <li {{ is_nav_active('laporan') }}>
            <a class="nav-link" href="{{ route('admin.laporan.index') }}">
                <i class="fas fa-folder-open"></i> Laporan Barang
            </a>
        </li>
    </ul>
</aside>
