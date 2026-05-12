@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Add New Product</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Fresh Mango" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Weight / Price Info</label>
                            <input type="text" name="weight" class="form-control" placeholder="e.g. 500g / ₹5" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Time</label>
                            <input type="text" name="delivery_time" class="form-control" placeholder="e.g. 30-45 mins">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Shelf Life</label>
                            <input type="text" name="shelf_life" class="form-control" placeholder="e.g. 2 days">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stock Status</label>
                            <input type="text" name="stock_status" class="form-control" placeholder="e.g. In Stock">
                        </div>
                    </div>

                    <!-- Full Width -->
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nutrition Info (Optional)</label>
                            <textarea name="nutrition" class="form-control" rows="2" placeholder="Enter nutrition details..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Storage Tips (Optional)</label>
                            <textarea name="storage_tips" class="form-control" rows="2" placeholder="How to store this product..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
