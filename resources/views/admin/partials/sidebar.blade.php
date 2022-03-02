<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="/employees">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Employee Management</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true"
            aria-controls="collapseSystem">
            <i class="fas fa-fw fa-cog"></i>
            <span>System management</span>
        </a>
        <div id="collapseSystem" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('countries.*') ? 'active' : '' }}"
                    href="{{ route('countries.index') }}">
                    Country
                </a>
                <a class="collapse-item {{ request()->routeIs('states.*') ? 'active' : '' }}"
                    href="{{ route('states.index') }}">
                    State
                </a>
                <a class="collapse-item {{ request()->routeIs('cities.*') ? 'active' : '' }}"
                    href="{{ route('cities.index') }}">
                    City
                </a>
                <a class="collapse-item {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                    href="{{ route('departments.index') }}">
                    Department
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
            aria-controls="collapseUser">
            <i class="fas fa-fw fa-user"></i>
            <span>User management</span>
        </a>
        <div id="collapseUser" class="collapse show" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    Users
                </a>
                <a class="collapse-item" href="utilities-border.html">Roles</a>
                <a class="collapse-item" href="utilities-animation.html">Permissions</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
