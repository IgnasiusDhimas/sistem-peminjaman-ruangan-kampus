@extends('layouts.app')

@section('content')
<div class="container col-md-6">

<h3>Edit Peminjaman</h3>
<hr>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('admin.peminjaman.update', $p->id) }}">
    @csrf
    @method('PUT')

    <label>User</label>
    <select name="user_id" class="form-control mb-2">
        @foreach($users as $u)
            <option value="{{ $u->id }}" @selected($u->id == $p->user_id)>
                {{ $u->name }} - {{ $u->email }}
            </option>
        @endforeach
    </select>

    <label>Gedung</label>
    <select name="gedung_id" id="gedung" class="form-control mb-2">
        @foreach($gedung as $g)
            <option value="{{ $g->id }}" @selected($g->id == $p->gedung_id)>
                {{ $g->nama }}
            </option>
        @endforeach
    </select>

    <label>Ruangan</label>
    <select name="ruang_id" id="ruang" class="form-control mb-2">
        @foreach($ruang as $r)
            <option value="{{ $r->id }}" @selected($r->id == $p->ruang_id)>
                {{ $r->nama }}
            </option>
        @endforeach
    </select>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ $p->tanggal }}" class="form-control mb-2">

    <label>Jam Mulai</label>
    <input type="time" name="jam_mulai" value="{{ $p->jam_mulai }}" class="form-control mb-2">

    <label>Jam Selesai</label>
    <input type="time" name="jam_selesai" value="{{ $p->jam_selesai }}" class="form-control mb-2">

    <label>Keperluan</label>
    <textarea name="keperluan" class="form-control mb-2">{{ $p->keperluan }}</textarea>

    <label>Catatan (opsional)</label>
    <textarea name="catatan" class="form-control" rows="2"></textarea>

    <button class="btn btn-success">Update</button>
</form>

</div>

<script>
document.getElementById('gedung').addEventListener('change', function(){
    fetch('/ajax/ruangan?gedung_id=' + this.value)
        .then(res => res.json())
        .then(data => {
            let ruang = document.getElementById('ruang');
            ruang.innerHTML = '';
            data.forEach(r => {
                ruang.innerHTML += `<option value="${r.id}">${r.nama}</option>`;
            });
        });
});
</script>

@endsection
