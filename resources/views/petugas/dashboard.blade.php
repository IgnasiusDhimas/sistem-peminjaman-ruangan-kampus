@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Dashboard Petugas</h3>
    <hr>

    <!-- Tombol Buat Booking -->
    <div class="mb-3">
        <a href="{{ route('petugas.peminjaman.create') }}" class="btn btn-success">
            + Buat Peminjaman Baru
        </a>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm">
                <h4>{{ $pending }}</h4>
                <p>Menunggu Verifikasi</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm">
                <h4>{{ $approved }}</h4>
                <p>Disetujui</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm">
                <h4>{{ $rejected }}</h4>
                <p>Ditolak</p>
            </div>
        </div>
    </div>

    <hr>
    <h4>Pengajuan Menunggu Verifikasi</h4>

    <!-- Tabel Pending -->
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menungguVerifikasi as $p)
                    <tr>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->gedung->nama }}</td>
                        <td>{{ $p->ruang->nama }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                        <td>{{ $p->keperluan }}</td>
                        <td class="text-center">
                            <a href="{{ route('petugas.peminjaman.detail', $p->id) }}"
                                class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">Tidak ada pengajuan pending.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Semua Peminjaman</h4>

    <!-- Tabel Semua Data -->
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaPeminjaman as $p)
                    <tr>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->gedung->nama }}</td>
                        <td>{{ $p->ruang->nama }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                        <td>
                            @if ($p->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif ($p->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('petugas.peminjaman.detail', $p->id) }}"
                               class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
