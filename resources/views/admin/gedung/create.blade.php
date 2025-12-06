@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Tambah Gedung</h3>

    <form method="POST" action="{{ route('admin.gedung.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Gedung</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>
    <a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">
                Kembali
    </a>

@endsection
