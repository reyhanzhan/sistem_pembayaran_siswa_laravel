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

    <!-- Logo dan Teks SB Admin 2 di kiri -->
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('img/logo_kartini.jpeg') }}" alt="Logo" class="logo-img mr-2" />
        <span class="brand-text font-weight-bold">Sistem Pembayaran Siswa</span>
    </a>

    <!-- Topbar Navbar kanan -->
    <ul class="navbar-nav ml-auto">
        <!-- User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Username</span>
                <img class="img-profile rounded-circle" src="https://via.placeholder.com/60" />
            </a>
            <!-- Dropdown - User Information -->
            {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div> --}}
        </li>
    </ul>
</nav>
