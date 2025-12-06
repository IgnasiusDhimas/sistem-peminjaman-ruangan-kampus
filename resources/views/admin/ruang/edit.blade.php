@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Ruangan</h3>

    <form method="POST" action="{{ route('admin.ruang.update', $ruang->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Ruang</label>
            <input type="text" name="nama" class="form-control" value="{{ $ruang->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Gedung</label>
            <select name="gedung_id" class="form-control" required>
                @foreach($gedungs as $g)
                    <option value="{{ $g->id }}" {{ $ruang->gedung_id == $g->id ? 'selected' : '' }}>
                        {{ $g->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ $ruang->kapasitas }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

</div>
<a href="{{ route('admin.ruang.index') }}" class="btn btn-secondary">
                Kembali
    </a>
@endsection
