<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center mt-9">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-user-circle fa-2x text-gray-300"></i> --}}
            <i class="fas fa-user-circle fa-2x text-gray-300" style="position: relative; top: -10px; left: -5px;"></i>
        </div>
        <div class="sidebar-brand-text mx-2">
            <div class="text-white">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
            <div class="text-gray-400 small">{{ Auth::check() ? Auth::user()->role : 'Tidak Login' }}</div>
        </div>
    </div>

    <hr class="sidebar-divider my-0" />
    
    @if (Auth::check())
        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Daftar Siswa</span>
                </a>
            </li>
        @elseif (Auth::user()->role === 'kepsek')
            <li class="nav-item {{ request()->routeIs('lihat-tagihan.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('lihat-tagihan.index') }}">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Lihat Tagihan</span>
                </a>
            </li>
        @endif

        {{-- <hr class="sidebar-divider d-none d-md-block" /> --}}
        <hr class="sidebar-divider my-0" />

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    @else
        <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-fw fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        </li>
    @endif
</ul>