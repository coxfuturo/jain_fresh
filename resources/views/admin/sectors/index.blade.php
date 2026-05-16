@extends('admin.layout.app')

@section('title', 'Sectors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Delivery Sectors</h3>
        <p class="text-muted small mb-0">Manage geographical sectors for deliveries</p>
    </div>
    <a href="{{ route('sectors.create') }}" class="btn btn-primary rounded-3 shadow-sm px-4">
        <i class="fas fa-plus me-2"></i> Add New Sector
    </a>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Sector Name</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sectors as $sector)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $sector->id }}</td>
                    <td>
                        <span class="fw-bold">{{ $sector->sector_name }}</span>
                    </td>
                    <td>
                        @if($sector->status == 1)
                            <span class="badge badge-soft-success">Active</span>
                        @else
                            <span class="badge badge-soft-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $sector->created_at->format('d M, Y') }}</td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm" title="Edit">
                                <i class="fas fa-edit text-muted"></i>
                            </a>
                            <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sector?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">No sectors found. Start by adding one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
