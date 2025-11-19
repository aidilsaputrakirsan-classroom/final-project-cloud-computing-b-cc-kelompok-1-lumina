@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">All Users</h1>
    
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body">
                    <h5 class="card-title">Total Account</h5>
                    <h2 class="display-4">{{ $totalUsers }} account</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white" style="background: linear-gradient(135deg, #48c6ef 0%, #6f86d6 100%);">
                <div class="card-body">
                    <h5 class="card-title">Total Admin</h5>
                    <h2 class="display-4">{{ $totalAdmin }} account</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <h2 class="display-4">{{ $totalRegularUsers }} account</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{ route('admin.users.search') }}" method="GET" class="d-flex gap-2">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Search by name or email"
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4">Search</button>
            </form>
        </div>
    </div>
    
    <!-- Users Table -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email Verified</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name ?? '-' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning">Not Verified</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ ($user->role ?? 'user') === 'admin' ? 'primary' : 'secondary' }}">
                                    {{ $user->role ?? 'user' }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                    
                                    <!-- Edit Button -->
                                    <button type="button" 
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $user->id }}">
                                        Edit
                                    </button>
                                    
                                    <!-- Make Admin Button -->
                                    @if(($user->role ?? 'user') !== 'admin')
                                    <form action="{{ route('admin.users.makeAdmin', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Make Admin
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" 
                                                       name="name" 
                                                       class="form-control" 
                                                       value="{{ $user->name }}"
                                                       required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" 
                                                       name="email" 
                                                       class="form-control" 
                                                       value="{{ $user->email }}"
                                                       required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="user" {{ ($user->role ?? 'user') === 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                    <option value="admin" {{ ($user->role ?? 'user') === 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">Tidak ada data user</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
