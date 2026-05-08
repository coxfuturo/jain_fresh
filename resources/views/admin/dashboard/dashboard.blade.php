@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Welcome Back, Admin!</h3>
        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-white border rounded-3 px-3 shadow-sm">
            <i class="far fa-calendar me-2"></i> This Month
        </button>
        <button class="btn btn-primary rounded-3 px-3 shadow-sm">
            <i class="fas fa-plus me-2"></i> Add Order
        </button>
    </div>
</div>

<!-- Stats Grid -->
<div class="row g-4 mb-4">
    <!-- Stat Card 1 -->
    <div class="col-12 col-md-6 col-lg">
        <div class="card card-stats border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stats-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-box"></i>
                </div>
            </div>
            <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Total Products</h6>
            <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_products'] }}</h4>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="col-12 col-md-6 col-lg">
        <div class="card card-stats border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stats-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-list"></i>
                </div>
            </div>
            <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Categories</h6>
            <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_categories'] }}</h4>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="col-12 col-md-6 col-lg">
        <div class="card card-stats border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-image"></i>
                </div>
            </div>
            <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Banners</h6>
            <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_banners'] }}</h4>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="col-12 col-md-6 col-lg">
        <div class="card card-stats border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stats-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Total Users</h6>
            <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_users'] }}</h4>
        </div>
    </div>

    <!-- Stat Card 5 -->
    <div class="col-12 col-md-6 col-lg">
        <div class="card card-stats border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stats-icon bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Coupons</h6>
            <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_coupons'] }}</h4>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="card border-0 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="fw-bold mb-1">Monthly Revenue Overview</h5>
                    <p class="text-muted small mb-0">Total earnings per month</p>
                </div>
            </div>
            <div style="height: 300px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border-0 p-4 h-100">
            <h5 class="fw-bold mb-1">Quick Links</h5>
            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('products.create') }}" class="btn btn-primary rounded-3 py-2 text-start">
                    <i class="fas fa-plus me-2"></i> Add New Product
                </a>
                <a href="{{ route('categories.create') }}" class="btn btn-info text-white rounded-3 py-2 text-start">
                    <i class="fas fa-folder-plus me-2"></i> Add Category
                </a>
                <a href="{{ route('banners.create') }}" class="btn btn-warning text-white rounded-3 py-2 text-start">
                    <i class="fas fa-image me-2"></i> Add Banner
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 p-4">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="fw-bold mb-1">Recently Added Products</h5>
                <p class="text-muted small mb-0">Latest additions to your catalog</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('products.index') }}" class="btn btn-light btn-sm rounded-3">View All</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Product ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price/Weight</th>
                    <th>Status</th>
                    <th class="pe-4 text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_products as $product)
                <tr>
                    <td class="ps-4 fw-bold">#{{ $product->productId ?? $product->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.$product->name }}" class="rounded-3" width="32" height="32" style="object-fit: cover;">
                            <span class="small">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border rounded-pill">{{ $product->category->name ?? 'N/A' }}</span></td>
                    <td class="small">{{ $product->weight }}</td>
                    <td>
                        @if($product->status)
                            <span class="badge badge-soft-success rounded-pill">Active</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Inactive</span>
                        @endif
                    </td>
                    <td class="pe-4 text-end">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-light rounded-circle"><i class="fas fa-edit text-muted"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white border-0 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">Showing {{ $recent_products->count() }} of {{ $stats['total_products'] }} records</span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link border-0" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link border-0" href="#">1</a></li>
                    <li class="page-item"><a class="page-link border-0" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sales Overview Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenue_data['labels']) !!},
            datasets: [{
                label: 'Monthly Revenue ($)',
                data: {!! json_encode($revenue_data['data']) !!},
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#4361ee'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#f1f3f4' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Traffic Source Chart
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    new Chart(trafficCtx, {
        type: 'doughnut',
        data: {
            labels: ['Organic', 'Direct', 'Social'],
            datasets: [{
                data: [45, 25, 30],
                backgroundColor: ['#4361ee', '#00ab55', '#ffab00'],
                borderWidth: 0,
                cutout: '80%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
