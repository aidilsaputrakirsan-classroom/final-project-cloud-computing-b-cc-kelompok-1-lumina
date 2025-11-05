@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label>Gender</label>
                            <input type="text" class="form-control" name="gender" value="{{ $user->gender }}">
                        </div>
                        <div class="mb-3">
                            <label>Age</label>
                            <input type="number" class="form-control" name="age" value="{{ $user->age }}">
                        </div>
                        <div class="mb-3">
                            <label>Street Name</label>
                            <input type="text" class="form-control" name="street_name" value="{{ $user->street_name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
