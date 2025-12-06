@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit User</h3>

    <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control">
            <small>Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

</div>
@endsection
