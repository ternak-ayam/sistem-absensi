<aside id="sidebar-wrapper">
    <div class="sidebar-brand mb-5">
        <a href="{{ url('/') }}">
{{--            <img width="120" src="{{ asset('assets/images/logo/pao.png') }}" alt="">--}}
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
{{--            <img width="40" src="{{ asset('assets/images/logo/pao.png') }}" alt="">--}}
        </a>
    </div>
    <ul class="sidebar-menu">
        <li {{ is_nav_active('dashboard') }}>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <li {{ is_nav_active('user') }}>
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fas fa-users"></i> <span>Pegawai</span>
            </a>
        </li>
{{--        <li {{ is_nav_active('presensi') }}>
            <a class="nav-link" href="{{ route('admin.presence.index') }}">
                <i class="fas fa-clipboard"></i> <span>Absensi</span>
            </a>
        </li>--}}
        <li {{ is_nav_active('absensi-pegawai') }}>
            <a class="nav-link" href="{{ route('admin.pegawai.presence.index') }}">
                <i class="fas fa-paste"></i> <span>Absensi Pegawai</span>
            </a>
        </li>
    </ul>
</aside>
