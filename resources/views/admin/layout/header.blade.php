<header class="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <button id="sidebarToggle" class="btn btn-light rounded-circle shadow-sm">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="search-bar d-none d-md-flex">
            <i class="fas fa-search text-muted"></i>
            <input type="text" placeholder="Search dashboard...">
        </div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-light rounded-circle position-relative shadow-sm" data-bs-toggle="dropdown">
                <i class="far fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-3" style="width: 300px;">
                <li class="mb-2"><h6 class="dropdown-header px-0 text-dark font-bold">Notifications</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item rounded-3 mb-1 py-2" href="#">New order received!</a></li>
                <li><a class="dropdown-item rounded-3 mb-1 py-2" href="#">Stock alert: Apples</a></li>
            </ul>
        </div>

        <div class="vr mx-2 bg-secondary opacity-25" style="height: 24px;"></div>

        <!-- User Profile -->
        <div class="dropdown">
            <button class="btn btn-light d-flex align-items-center gap-2 rounded-pill px-2 py-1 shadow-sm" data-bs-toggle="dropdown">
                <div class="d-none d-lg-block text-end me-1">
                    <div class="fw-bold small leading-none">Admin User</div>
                    <div class="text-muted extra-small" style="font-size: 0.7rem;">Super Admin</div>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=4361ee&color=fff" class="rounded-circle" width="32" height="32">
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 mt-2">
                <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="far fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="fas fa-shield-alt me-2"></i> Security</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item rounded-3 py-2 text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>
