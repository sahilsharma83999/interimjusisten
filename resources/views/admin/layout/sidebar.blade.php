<ul class="navbar-nav bg-gradient-primary sidebar sidebar_cst sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <img src="{{ asset('img/interimlogo.png') }}">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->is('admin/users-list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin-users-list') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ request()->is('admin/stellenangebote') || request()->is('admin/stellenangebote/edit') || request()->is('admin/stellenangebote/edit/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('edit-job-offerings') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Stellenangebote</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin-search') ? 'active' : '' }}">
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
