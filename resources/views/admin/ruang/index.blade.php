@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Daftar Ruangan</h3>
    <a href="{{ route('admin.ruang.create') }}" class="btn btn-primary mb-3">Tambah Ruang</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Ruang</th>
                <th>Gedung</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruangs as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->gedung->nama }}</td>
                <td>{{ $r->kapasitas }}</td>
                <td>
                    <a href="{{ route('admin.ruang.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form method="POST" action="{{ route('admin.ruang.destroy', $r->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus ruang?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>

@endsection
