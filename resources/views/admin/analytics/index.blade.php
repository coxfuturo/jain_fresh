@extends('admin.layout.app')

@section('title', 'Analytics')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <h3 class="fw-bold text-dark mb-1">System Analytics</h3>
    <p class="text-muted mb-0">Deep dive into your store's data and trends.</p>
</div>

<div class="row g-4 mb-4">
    <!-- Categories Breakdown -->
    <div class="col-12 col-xl-8">
        <div class="card border-0 p-4 h-100">
            <h5 class="fw-bold mb-4">Products per Category</h5>
            <div style="height: 350px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 p-4 h-100">
            <h5 class="fw-bold mb-4">Quick Summary</h5>
            <div class="d-grid gap-3">
                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block">Total Products</span>
                        <span class="fw-bold h5 mb-0">{{ $stats['total_products'] }}</span>
                    </div>
                    <div class="stats-icon bg-primary bg-opacity-10 text-primary mb-0">
                        <i class="fas fa-box small"></i>
                    </div>
                </div>
                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block">Active Categories</span>
                        <span class="fw-bold h5 mb-0">{{ $stats['total_categories'] }}</span>
                    </div>
                    <div class="stats-icon bg-info bg-opacity-10 text-info mb-0">
                        <i class="fas fa-list small"></i>
                    </div>
                </div>
                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block">Registered Users</span>
                        <span class="fw-bold h5 mb-0">{{ $stats['total_users'] }}</span>
                    </div>
                    <div class="stats-icon bg-success bg-opacity-10 text-success mb-0">
                        <i class="fas fa-users small"></i>
                    </div>
                </div>
            </div>

            <div class="mt-auto pt-4">
                <h6 class="fw-bold small text-uppercase text-muted mb-3">Top Categories</h6>
                @foreach($topCategories as $cat)
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small">{{ $cat->name }}</span>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">{{ $cat->products_count }} Products</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- User Registration Trend -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 p-4 h-100">
            <h5 class="fw-bold mb-4">User Registrations (Monthly)</h5>
            <div style="height: 300px;">
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Category Distribution Pie -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 p-4 h-100">
            <h5 class="fw-bold mb-4">Category Distribution</h5>
            <div style="height: 300px;">
                <canvas id="distributionPie"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Bar Chart: Products per Category
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoryDistribution->pluck('name')->toArray()) !!},
            datasets: [{
                label: 'Products Count',
                data: {!! json_encode($categoryDistribution->pluck('count')->toArray()) !!},
                backgroundColor: '#4361ee',
                borderRadius: 8,
                barThickness: 30
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

    // Line Chart: User Registrations
    const userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($userRegistrations->pluck('month')->toArray()) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode($userRegistrations->pluck('count')->toArray()) !!},
                borderColor: '#00ab55',
                backgroundColor: 'rgba(0, 171, 85, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#00ab55'
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

    // Pie Chart: Category Distribution
    const pieCtx = document.getElementById('distributionPie').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryDistribution->pluck('name')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($categoryDistribution->pluck('count')->toArray()) !!},
                backgroundColor: ['#4361ee', '#00ab55', '#ffab00', '#00b8d9', '#ff5630', '#7a0c2e'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 12 }
                    }
                } 
            }
        }
    });
</script>
@endpush
