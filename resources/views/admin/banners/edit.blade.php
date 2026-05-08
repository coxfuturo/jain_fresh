@extends('admin.layout.app')

@section('title', 'Edit Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('banners.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Edit Banner: {{ $banner->name }}</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="form-label fw-bold">Banner Name (Internal)</label>
                    <input type="text" name="name" class="form-control" value="{{ $banner->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Banner Title (Display)</label>
                    <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Current Image</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$banner->image) }}" class="rounded-3 shadow-sm" width="200" style="height: 100px; object-fit: cover;">
                    </div>
                    <label class="form-label fw-bold">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
