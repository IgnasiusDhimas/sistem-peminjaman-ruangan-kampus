@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Tambah Ruangan</h3>

    <form method="POST" action="{{ route('admin.ruang.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Ruang</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gedung</label>
            <select name="gedung_id" class="form-control" required>
                <option value="">-- Pilih Gedung --</option>
                @foreach($gedungs as $g)
                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>
<a href="{{ route('admin.ruang.index') }}" class="btn btn-secondary">Kembali</a>

@endsection
