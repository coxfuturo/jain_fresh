<nav id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="sidebar-logo-icon">
                <img src="{{ asset('logoImg/logo.png') }}" alt="" height="40" width="40">
            </div>
            <h5 class="mb-0 fw-bold">Zain Fresh</h5>
        </div>
        <button class="btn d-lg-none text-muted p-0" onclick="document.getElementById('sidebarToggle').click()">
            <i class="fas fa-times fs-4"></i>
        </button>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Main Menu</div>
        
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('banners.index') }}" class="sidebar-link {{ request()->routeIs('banners.*') ? 'active' : '' }}">
            <i class="fas fa-image"></i>
            <span>Banners</span>
        </a>

        <a href="{{ route('categories.index') }}" class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fas fa-list"></i>
            <span>Categories</span>
        </a>

        <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-box"></i>
            <span>Products</span>
        </a>

        <a href="{{ route('coupons.index') }}" class="sidebar-link {{ request()->routeIs('coupons.*') ? 'active' : '' }}">
            <i class="fas fa-ticket-alt"></i>
            <span>Coupons</span>
        </a>
        
        <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
        </a>

        <div class="dropdown">
            <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        </div>

        <div class="nav-label">System</div>

        <a href="{{ route('admin.analytics') }}" class="sidebar-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
        </a>

        <a href="#" class="sidebar-link">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="mt-auto p-4 border-top">
        <a href="{{ url('/') }}" target="_blank" class="btn btn-light w-100 rounded-3 text-start d-flex align-items-center gap-2">
            <i class="fas fa-external-link-alt small"></i>
            <span>View Site</span>
        </a>
    </div>
        </li>
    </ul>
</nav>
