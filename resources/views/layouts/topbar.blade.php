<style>
    .logo-img {
        width: 70px;
        /* Atur lebar sesuai kebutuhan */
        height: auto;
        /* Tinggi menyesuaikan lebar supaya proporsional */
        display: block;
        /* Supaya tidak ada spasi bawah */
        margin: 0 auto;
        /* Supaya posisi gambar center di dalam div */
    }

    .sidebar-brand-icon {
        margin-top: 20px;
        /* Sesuaikan jaraknya */
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link  rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Logo dan Teks SB Admin 2 di kiri -->
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('img/logo_kartini.jpeg') }}" alt="Logo" class="logo-img mr-2" />
        <span class="brand-text font-weight-bold">SMK Kartini Surabaya</span>
    </a>

    <!-- Topbar Navbar kanan -->
    {{-- <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::user()->name ?? 'Guest' }}
                </span>
                <i class="fas fa-user-circle fa-2x text-gray-600"></i>
            </a>
        </li>
    </ul> --}}
</nav>
