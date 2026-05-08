@extends('admin.layout.app')

@section('title', 'Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">System Users</h3>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Joined</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $user->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" class="rounded-circle" width="32">
                            <span class="fw-bold">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td class="small text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                <i class="fas fa-edit text-muted"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
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
                    <td colspan="6" class="text-center py-5 text-muted">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
