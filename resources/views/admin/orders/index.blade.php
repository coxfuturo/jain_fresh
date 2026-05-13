@extends('admin.layout.app')

@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manage Orders</h3>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Customer</th>
                    <th>Subtotal</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="ps-4">
                        <span class="fw-bold">#{{ $order->id }}</span>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-dark">{{ $order->user->name ?? 'Guest' }}</span>
                            <span class="text-muted small">{{ $order->user->phone ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td>₹{{ number_format($order->subtotal, 2) }}</td>
                    <td><span class="fw-bold text-primary">₹{{ number_format($order->total_amount, 2) }}</span></td>
                    <td>
                        <span class="badge rounded-pill {{ $order->payment_status == 'Paid' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }}">
                            {{ $order->payment_status }}
                        </span>
                        <div class="small text-muted mt-1">{{ $order->payment_method }}</div>
                    </td>
                    <td>
                        @php
                            $statusBadge = match($order->order_status) {
                                'Pending' => 'bg-secondary',
                                'Processing' => 'bg-info',
                                'Shipped' => 'bg-primary',
                                'Delivered' => 'bg-success',
                                'Cancelled' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusBadge }} rounded-pill">{{ $order->order_status }}</span>
                    </td>
                    <td class="text-muted small">
                        {{ $order->created_at->format('d M, Y') }}<br>
                        {{ $order->created_at->format('h:i A') }}
                    </td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm" title="View Details">
                                <i class="fas fa-eye text-primary"></i>
                            </a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm text-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="fas fa-shopping-basket fa-3x mb-3 opacity-25"></i>
                        <p>No orders found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
