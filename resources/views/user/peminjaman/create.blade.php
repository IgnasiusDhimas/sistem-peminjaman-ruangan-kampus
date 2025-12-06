@extends('layouts.app')

@section('content')
<div class="container col-md-6">

    <h3>Ajukan Peminjaman Ruangan</h3>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.peminjaman.store') }}">
        @csrf

        <!-- Gedung -->
        <div class="mb-3">
            <label>Gedung</label>
            <select name="gedung_id" id="gedung" class="form-control" required>
                <option value="">-- Pilih Gedung --</option>
                @foreach ($gedungs as $g)
                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ruang -->
        <div class="mb-3">
            <label>Ruangan</label>
            <select name="ruang_id" id="ruang" class="form-control" required>
                <option value="">-- Pilih Ruangan --</option>
            </select>
        </div>

        <!-- Tanggal -->
        <div class="mb-3">
            <label>Tanggal Peminjaman</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <!-- Jam -->
        <div class="row mb-3">
            <div class="col">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>

            <div class="col">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
        </div>

        <!-- Keperluan -->
        <div class="mb-3">
            <label>Keperluan</label>
            <input type="text" name="keperluan" class="form-control" placeholder="Contoh: Rapat, Presentasi, dll" required>
        </div>

        <!-- Catatan -->
        <div class="mb-3">
            <label>Catatan (opsional)</label>
            <textarea name="catatan" class="form-control" rows="2"></textarea>
        </div>

        <button class="btn btn-primary w-100">Ajukan</button>
    </form>
</div>

<script>
// AJAX load ruang berdasarkan gedung
document.getElementById('gedung').addEventListener('change', function() {
    let gId = this.value;

    fetch('/ajax/ruangan?gedung_id=' + gId)
        .then(res => res.json())
        .then(data => {
            let ruangSelect = document.getElementById('ruang');
            ruangSelect.innerHTML = '<option value="">-- Pilih Ruangan --</option>';

            data.forEach(r => {
                ruangSelect.innerHTML += `<option value="${r.id}">
                    ${r.nama} (Kapasitas: ${r.kapasitas} orang)
                </option>`;
            });

        });
});
</script>
@endsection
