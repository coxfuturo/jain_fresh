@extends('admin.layout.app')

@section('title', 'Banners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manage Banners</h3>
    <a href="{{ route('banners.create') }}" class="btn btn-primary rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i> Add New Banner
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4">
    @forelse($banners as $banner)
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm overflow-hidden h-100">
            <div class="position-relative">
                <img src="{{ asset('storage/'.$banner->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="position-absolute top-0 end-0 m-2">
                    @if($banner->status)
                    <span class="badge bg-success rounded-pill shadow-sm">Active</span>
                    @else
                    <span class="badge bg-danger rounded-pill shadow-sm">Inactive</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <h5 class="fw-bold mb-1">{{ $banner->title }}</h5>
                <p class="text-muted small mb-3">{{ $banner->name }}</p>
                
                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                    <span class="small text-muted">{{ $banner->created_at->format('M d, Y') }}</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm">Edit</a>
                        <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm p-5 text-center text-muted">
            <i class="far fa-images fa-3x mb-3 opacity-25"></i>
            <p>No banners found. Start by adding one!</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
