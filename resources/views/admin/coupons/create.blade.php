@extends('admin.layout.app')

@section('title', 'Create Coupon')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('coupons.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Create New Coupon</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('coupons.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Coupon Code (e.g. SAVE50)</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter coupon code" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Coupon Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Special Holiday Discount" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Discount Amount</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold">₹</span>
                        <input type="number" name="amount" class="form-control" placeholder="0.00" step="0.01" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Description (Optional)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter coupon details..."></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Save Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
