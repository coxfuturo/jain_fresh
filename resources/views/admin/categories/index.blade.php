@extends('admin.layout.app')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manage Categories</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i> Add New Category
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $category->id }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$category->image) }}" class="rounded-3 shadow-sm" width="48" height="48" style="object-fit: cover;">
                    </td>
                    <td class="fw-bold">{{ $category->name }}</td>
                    <td>
                        @if($category->status)
                        <span class="badge badge-soft-success rounded-pill">Active</span>
                        @else
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Inactive</span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $category->created_at->format('M d, Y') }}</td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                <i class="fas fa-edit text-muted"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                        <p>No categories found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
