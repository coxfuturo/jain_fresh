@extends('admin.layout.app')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Edit Product: {{ $product->name }}</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Weight / Price Info (Multiple: 500g/50, 1kg/100)</label>
                            @php
                                $weightValue = is_array($product->weight) 
                                    ? implode(', ', array_map(fn($item) => $item['weight'].'/'.$item['price'], $product->weight)) 
                                    : $product->weight;
                            @endphp
                            <input type="text" name="weight" class="form-control" value="{{ $weightValue }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Image</label>
                            <div class="mb-2">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.$product->name }}" class="rounded-3 shadow-sm" width="80" height="80" style="object-fit: cover;">
                            </div>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stock Status</label>
                            <input type="text" name="stock_status" class="form-control" value="{{ $product->stock_status }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nutrition Info</label>
                            <textarea name="nutrition" class="form-control" rows="2">{{ $product->nutrition }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Storage Tips</label>
                            <textarea name="storage_tips" class="form-control" rows="2">{{ $product->storage_tips }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
