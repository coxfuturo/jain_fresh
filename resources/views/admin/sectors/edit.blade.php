@extends('admin.layout.app')

@section('title', 'Edit Sector')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('sectors.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h3 class="fw-bold mb-0">Edit Sector</h3>
                <p class="text-muted small mb-0">Update delivery area details</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 p-lg-5">
            <form action="{{ route('sectors.update', $sector->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="form-label fw-bold">Sector Name</label>
                    <input type="text" name="sector_name" class="form-control" value="{{ $sector->sector_name }}" required>
                    @error('sector_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $sector->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $sector->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-primary rounded-3 py-3 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Sector
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
