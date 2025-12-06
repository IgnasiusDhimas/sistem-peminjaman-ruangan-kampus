@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Gedung</h3>

    <form method="POST" action="{{ route('admin.gedung.update', $gedung->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Gedung</label>
            <input type="text" name="nama" class="form-control" value="{{ $gedung->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $gedung->deskripsi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

</div>
<a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">
                Kembali
    </a>
@endsection
