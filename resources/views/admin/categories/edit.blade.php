@extends('admin.layout.app')

@section('title', 'Edit Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('categories.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Edit Category: {{ $category->name }}</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="form-label fw-bold">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Current Image</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$category->image) }}" class="rounded-3 shadow-sm" width="100">
                    </div>
                    <label class="form-label fw-bold">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
