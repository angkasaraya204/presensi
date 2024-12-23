<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Presensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://static.vecteezy.com/system/resources/previews/022/123/337/original/user-icon-profile-icon-account-icon-login-sign-line-vector.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                @if (auth()->user()->level !== "admin")
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Presensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('presensi-masuk') }}" class="nav-link ">
                                <i class="fas fa-sign-in-alt"></i>
                                <p>Presensi Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('presensi-keluar') }}" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Presensi Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->level !== "admin")
                        <li class="nav-item">
                            <a href="{{ route('semua-presensi') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Presensi Per Karyawan</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('semua-rekap') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Presensi Keseluruhan</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
