    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('chasier.index') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('img/logo_rsagung.jpeg') }}" height="50" alt="brand">
            </div>
            <div class="sidebar-brand-text mx-3">{{ $role['role_name'] }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('chasier.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('chas.inpatient') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Rawat Inap</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('chas.outpatient') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Rawat Jalan</span></a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.room') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Kamar</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.doctor') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Set Dokter</span></a>
        </li> --}}

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
