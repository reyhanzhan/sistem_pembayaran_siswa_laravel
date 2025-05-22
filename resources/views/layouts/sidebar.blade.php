<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <br>
    <hr class="sidebar-divider my-0" />

    <li class="nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('siswa.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Siswa</span>
        </a>
    </li>

    {{-- @if(isset($siswa))
        <li class="nav-item {{ request()->routeIs('siswa.tagihan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('siswa.tagihan.index', ['siswa' => $siswa->id]) }}">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span>Tagihan</span>
            </a>
        </li>
    @endif --}}

    <hr class="sidebar-divider d-none d-md-block" />

    @if (Auth::check())
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