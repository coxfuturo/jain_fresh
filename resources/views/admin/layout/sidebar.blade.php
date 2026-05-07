<nav id="sidebar">
    <div class="sidebar-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0 px-2 fw-bold text-white">Zain Fresh</h4>
        {{-- Close button for mobile --}}
        <button type="button" class="btn btn-sm btn-outline-light d-md-none" id="sidebarCloseBtn" onclick="document.getElementById('sidebar').classList.toggle('active');">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#usersSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users fa-fw me-2"></i> Users
            </a>
            <ul class="collapse list-unstyled" id="usersSubmenu">
                <li>
                    <a href="#" class="ps-5"><i class="fas fa-caret-right me-2"></i>All Users</a>
                </li>
                <li>
                    <a href="#" class="ps-5"><i class="fas fa-caret-right me-2"></i>Add User</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-cogs fa-fw me-2"></i> Settings
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-chart-bar fa-fw me-2"></i> Reports
            </a>
        </li>
    </ul>

    <ul class="list-unstyled">
        <li>
            <a href="{{ url('/') }}" target="_blank">
                <i class="fas fa-external-link-alt fa-fw me-2"></i> View Site
            </a>
        </li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
