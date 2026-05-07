<nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-3 border-bottom">
    <div class="container-fluid px-0">
        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-center">
            <!-- Notifications Dropdown -->
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownNotifications" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-danger rounded-pill position-absolute top-0 start-50 translate-middle-x mt-1" style="font-size: 0.65rem;">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdownNotifications">
                    <h6 class="dropdown-header">Alerts Center</h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="me-3">
                            <div class="bg-primary rounded-circle p-2 text-white"><i class="fas fa-file-alt"></i></div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2026</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
            </li>

            <!-- User Information Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="me-2 d-none d-lg-inline text-gray-600 small">Admin User</span>
                    <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" width="32" height="32">
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdownUser">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#"
   onclick="event.preventDefault(); document.getElementById('dropdown-logout-form').submit();">

    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
    Logout

</a>

<form id="dropdown-logout-form"
      action="{{ route('admin.logout') }}"
      method="POST"
      class="d-none">

    @csrf

</form>
                </div>
            </li>
        </ul>
    </div>
</nav>
