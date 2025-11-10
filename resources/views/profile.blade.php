@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center">

    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">

        <div class="text-center mb-4">
            <div class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center"
                style="width: 70px; height: 70px; font-size: 30px;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <h3 class="mt-3">{{ Auth::user()->name }}</h3>
            <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>

        <hr>

        <div class="mb-3">
            <strong>Gender</strong>
            <p>{{ Auth::user()->gender ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Age</strong>
            <p>{{ Auth::user()->age ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Street Name</strong>
            <p>{{ Auth::user()->street_name ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Role</strong>
            <p>{{ Auth::user()->role ?? '-' }}</p>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary w-50 me-2">Edit Profile</a>

            <form action="{{ route('logout') }}" method="POST" class="w-50 ms-2">
                @csrf
                <button type="submit" class="btn btn-light border w-100">Logout</button>
            </form>
        </div>

    </div>
</div>

@if(Auth::user()->role === 'admin')
<div class="container d-flex justify-content-center mt-4">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%; text-align: center;">
        <h5 class="mb-3">Admin Quick Access</h5>

        {{-- 🔥 LINK FIX, INI WAJIB --}}
        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning px-4">
            Dashboard Admin
        </a>
    </div>
</div>
@endif

@endsection
