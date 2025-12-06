@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Peminjaman</h3>
    <hr>

    <form action="{{ route('petugas.peminjaman.update', $p->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Gedung</label>
                    <input type="text" class="form-control" value="{{ $p->ruang->gedung->nama }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ruangan</label>
                    <input type="text" class="form-control" value="{{ $p->ruang->nama }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ $p->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control"
                           value="{{ $p->jam_mulai }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control"
                           value="{{ $p->jam_selesai }}" required>
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Keperluan</label>
                    <textarea name="keperluan" rows="5" class="form-control" required>{{ $p->keperluan }}</textarea>
                </div>

            </div>
            <!-- Catatan -->
            <div class="mb-3">
                <label>Catatan (opsional)</label>
                <textarea name="catatan" class="form-control" rows="2"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">Batal</a>

    </form>

</div>
@endsection
