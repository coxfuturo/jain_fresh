@extends('admin.layout.app')

@section('title', 'Add Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('banners.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Add New Banner</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Banner Name (Internal)</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Home Page Main Banner" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Banner Title (Display)</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. 50% Off on Fresh Fruits" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Banner Image</label>
                    <div class="border rounded-3 p-3 bg-light text-center">
                        <i class="fas fa-image fa-2x mb-2 text-primary opacity-50"></i>
                        <p class="small text-muted mb-3">Upload a high-quality landscape image (Suggested size: 1200x400)</p>
                        <input type="file" name="image" class="form-control" required accept="image/*">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-upload me-2"></i> Upload Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
