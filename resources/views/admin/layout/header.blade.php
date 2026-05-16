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
                @if(($stats['pending_orders_count'] ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        {{ $stats['pending_orders_count'] }}
                    </span>
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-3" style="width: 320px;">
                <li class="mb-2 d-flex justify-content-between align-items-center">
                    <h6 class="dropdown-header px-0 text-dark fw-bold mb-0">Notifications</h6>
                    <span class="badge bg-primary-light text-primary small">{{ $stats['pending_orders_count'] ?? 0 }} New</span>
                </li>
                <li><hr class="dropdown-divider"></li>
                @forelse($pending_notifications ?? [] as $notification)
                    <li>
                        <a class="dropdown-item rounded-3 mb-1 py-2 d-flex align-items-center gap-3" href="{{ route('orders.show', $notification->id) }}">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; flex-shrink: 0;">
                                <i class="fas fa-shopping-basket small"></i>
                            </div>
                            <div class="d-flex flex-column overflow-hidden">
                                <span class="fw-bold small text-dark text-truncate">New Order #{{ $notification->id }}</span>
                                <span class="text-muted extra-small">From {{ $notification->user->name ?? 'Guest' }}</span>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="text-center py-3">
                        <i class="fas fa-bell-slash text-muted opacity-25 mb-2 fa-2x"></i>
                        <p class="text-muted small mb-0">No new notifications</p>
                    </li>
                @endforelse
                @if(($stats['pending_orders_count'] ?? 0) > 0)
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center small text-primary fw-bold" href="{{ route('orders.index') }}">View All Orders</a></li>
                @endif
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
                <li><a class="dropdown-item rounded-3 py-2 text-danger" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>
