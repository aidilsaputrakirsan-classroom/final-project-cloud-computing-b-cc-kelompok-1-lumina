@extends('layouts.app')

@section('title', 'Profile Akun')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8">
    <div class="card border-0 shadow-lg rounded-4">
      <div class="card-body p-5">
        <div class="d-flex align-items-center mb-4">
          <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center shadow" style="width: 70px; height: 70px;">
            <span class="fs-1 fw-bold text-white">{{ strtoupper(substr($user->name,0,1)) }}</span>
          </div>
          <div class="ms-4">
            <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
            <span class="text-muted">{{ $user->email }}</span>
          </div>
        </div>

        <hr>
        <dl class="row mb-4">
          <dt class="col-5 text-muted small fw-semibold">Gender</dt>
          <dd class="col-7 mb-2">{{ $user->gender ?? '-' }}</dd>
          <dt class="col-5 text-muted small fw-semibold">Age</dt>
          <dd class="col-7 mb-2">{{ $user->age ?? '-' }}</dd>
          <dt class="col-5 text-muted small fw-semibold">Street Name</dt>
          <dd class="col-7 mb-2">{{ $user->street_name ?? '-' }}</dd>
          <dt class="col-5 text-muted small fw-semibold">Role</dt>
          <dd class="col-7 mb-2">{{ $user->role ?? '-' }}</dd>
        </dl>

        <div class="d-flex gap-2">
<a href="{{ route('profile.edit') }}" class="btn btn-primary flex-grow-1 fw-semibold">
  <i class="bi bi-pencil-square me-1"></i> Edit Profile
</a>

          <a href="{{ route('logout') }}" class="btn btn-light flex-grow-1 text-danger text-decoration-none border">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection