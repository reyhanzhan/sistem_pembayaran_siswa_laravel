<!-- Sidebar Example -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Divider -->
    <br>
    <hr class="sidebar-divider my-0" />
    <!-- Nav Item -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li> --}}

    <li class="nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('siswa.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Siswa</span>
        </a>
    </li>


    @if(isset($siswa))
        <li class="nav-item {{ request()->routeIs('tagihan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tagihan.index', ['siswa' => $siswa->id]) }}">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span>Tagihan</span>
            </a>
        </li>
    @endif

</ul>
