@extends('admin.layout.app')

@section('title', 'Add Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('categories.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Add New Category</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Category Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Category Image</label>
                    <div class="border rounded-3 p-3 bg-light text-center">
                        <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-primary opacity-50"></i>
                        <p class="small text-muted mb-3">Upload a clean image for the category</p>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required accept="image/*">
                    </div>
                    @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
