<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <img style="background-color: #fff" src="{{ asset('img/logo.png') }}">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-users-list') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('edit-job-offerings') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Stellenangebote</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin-search') }}">
            <i class="fas fa-fw fa-search"></i>
            <span>Search</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('export/xlsx') }}">
            <i class="fas fa-file-csv"></i>
            <span>Export</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('auth/logout') }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>Logout</span></a>
    </li>
</ul>
