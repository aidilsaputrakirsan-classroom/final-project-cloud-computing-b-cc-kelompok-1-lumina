@extends('layouts.app')

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
            <div class="mb-2">
              <label>Nama</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-2">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            </div>
            <!-- Gender, Age, Street Name -->
            <div class="mb-2">
              <label>Gender</label>
              <select name="gender" class="form-control">
                <option value="">Pilih Gender</option>
                <option value="male" @if($user->gender=='male') selected @endif>Laki-laki</option>
                <option value="female" @if($user->gender=='female') selected @endif>Perempuan</option>
              </select>
            </div>
            <div class="mb-2">
              <label>Age</label>
              <input type="number" name="age" class="form-control" value="{{ $user->age }}">
            </div>
            <div class="mb-2">
              <label>Street Name</label>
              <input type="text" name="street_name" class="form-control" value="{{ $user->street_name }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
