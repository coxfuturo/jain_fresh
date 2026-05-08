@extends('admin.layout.app')

@section('title', 'Edit User')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('users.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <h3 class="fw-bold mb-0">Edit User: {{ $user->name }}</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold text-danger">New Password (Optional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                        <div class="small text-muted mt-1">Only fill this if you want to change the user's password.</div>
                    </div>
                </div>

                <div class="d-grid mt-2">
                    <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update User Details
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
