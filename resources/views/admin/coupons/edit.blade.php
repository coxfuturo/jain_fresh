@extends('admin.layout.app')

@section('title', 'Edit Coupon')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('coupons.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Edit Coupon: {{ $coupon->name }}</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="form-label fw-bold">Coupon Code</label>
                    <input type="text" name="name" class="form-control" value="{{ $coupon->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Coupon Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $coupon->title }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Discount Amount</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold">$</span>
                        <input type="number" name="amount" class="form-control" value="{{ $coupon->amount }}" step="0.01" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $coupon->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
