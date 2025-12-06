@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Daftar Gedung</h3>
    <a href="{{ route('admin.gedung.create') }}" class="btn btn-primary mb-2">Tambah</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gedungs as $g)
            <tr>
                <td>{{ $g->nama }}</td>
                <td>{{ $g->deskripsi }}</td>
                <td>
                    <a href="{{ route('admin.gedung.edit', $g->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.gedung.destroy', $g->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>

@endsection
