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
        @auth('web')
            <li {{ is_nav_active('/') }}>
                <a class="nav-link" href="{{ route('user.dashboard.index') }}">
                    <i class="fas fa-user"></i> <span>Profil</span>
                </a>
            </li>
            <li {{ is_nav_active('presensi') }}>
                <a class="nav-link" href="{{ route('user.presence.index') }}">
                    <i class="fas fa-paste"></i> <span>Absensi</span>
                </a>
            </li>
        @endauth

        @auth('admin')
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
            <li {{ is_nav_active('presensi') }}>
                <a class="nav-link" href="{{ route('admin.presence.index') }}">
                    <i class="fas fa-clipboard"></i> <span>Absensi</span>
                </a>
            </li>
        @endauth
    </ul>
</aside>
