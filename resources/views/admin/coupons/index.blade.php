@extends('admin.layout.app')

@section('title', 'Coupons')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manage Coupons</h3>
    <a href="{{ route('coupons.create') }}" class="btn btn-primary rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i> Create Coupon
    </a>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Code</th>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                <tr>
                    <td class="ps-4 fw-bold text-primary">{{ $coupon->name }}</td>
                    <td>{{ $coupon->title }}</td>
                    <td class="fw-bold">${{ number_format($coupon->amount, 2) }}</td>
                    <td>
                        @if($coupon->status)
                        <span class="badge badge-soft-success rounded-pill">Active</span>
                        @else
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Inactive</span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $coupon->created_at->format('M d, Y') }}</td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                <i class="fas fa-edit text-muted"></i>
                            </a>
                            <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete this coupon?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No coupons found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
