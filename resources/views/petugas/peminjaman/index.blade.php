@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Daftar Peminjaman Pending</h3>
    <hr>

    <div class="mb-3">
        <a href="{{ route('petugas.peminjaman.create') }}" class="btn btn-success">
            + Buat Peminjaman Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($peminjaman as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->ruang->gedung->nama }}</td>
                        <td>{{ $item->ruang->nama }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                        <td>{{ $item->keperluan }}</td>
                        <td>
                            <a href="{{ route('petugas.peminjaman.detail', $item->id) }}"
                               class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada peminjaman pending.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
    <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">
                Kembali
            </a>

</div>
@endsection
