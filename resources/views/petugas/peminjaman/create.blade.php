@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Buat Peminjaman Baru</h3>
    <hr>

    <form action="{{ route('petugas.peminjaman.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Pilih Gedung</label>
                    <select name="gedung_id" class="form-control" id="gedungSelect" required>
                        <option value="">-- pilih gedung --</option>
                        @foreach ($gedung as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Ruangan</label>
                    <select name="ruang_id" class="form-control" id="ruangSelect" required>
                        <option value="">-- pilih ruangan --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Keperluan</label>
                    <textarea name="keperluan" class="form-control" rows="5" required></textarea>
                </div>

            </div>
            <!-- Catatan -->
            <div class="mb-3">
                <label>Catatan (opsional)</label>
                <textarea name="catatan" class="form-control" rows="2"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>

        <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">Batal</a>

    </form>

</div>

<script>
    document.getElementById('gedungSelect').addEventListener('change', function() {
        const gedungId = this.value;

        fetch('/ajax/ruang/' + gedungId)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- pilih ruangan --</option>';

                data.forEach(r => {
                    options += `<option value="${r.id}">
                        ${r.nama} (Kapasitas: ${r.kapasitas} orang)
                    </option>`;
                });

                document.getElementById('ruangSelect').innerHTML = options;
            });
    });
</script>

@endsection
