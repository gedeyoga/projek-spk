<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link d-flex align-items-center">

        <img src="{{ asset('image/logo.jpeg') }}" alt="{{ env('APP_NAME') }}" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light ml-2" style="text-wrap: wrap;">
            {{ env('APP_NAME') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- SidebarSearch Form -->
        <div class="form-inline">

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item">

                    <a class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">


                    <a href="{{ route('alternatif.index') }}" class="nav-link {{ request()->segment(1) == 'alternatif' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Alternatif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kriteria.index') }}" class="nav-link {{ request()->segment(1) == 'kriteria' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('nilai-kriteria.index') }}" class="nav-link {{ request()->segment(1) == 'nilai-kriteria' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Nilai Kriteria
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ request()->segment(1) == 'bars' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Bars

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bars.performance') }}" class="nav-link {{ request()->segment(2) == 'performance' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peformance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bars.critical-incident') }}" class="nav-link {{ request()->segment(2) == 'critical-incident' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Insiden Krisis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bars.final-instrument') }}" class="nav-link {{ request()->segment(2) == 'final-instrument' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Final Instrumen
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('perhitungan.index') }}" class="nav-link {{ request()->segment(1) == 'perhitungan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Perhitungan
                        </p>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->segment(1) == 'laporan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('company.edit') }}" class="nav-link {{ request()->segment(1) == 'setting' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>