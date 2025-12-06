@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Dashboard User</h3>
        <div>
            <a href="{{ route('user.peminjaman.create') }}" class="btn btn-primary me-2">
                + Ajukan Peminjaman
            </a>
            <a href="{{ route('user.peminjaman.index') }}" class="btn btn-outline-secondary">
                Lihat Semua
            </a>
        </div>
    </div>

    <hr>

    <!-- PEMINJAMAN AKTIF -->
    <h5>Peminjaman Aktif</h5>

    @if ($active->count() == 0)
        <p class="text-muted">Tidak ada peminjaman aktif.</p>
    @else
        <div class="list-group mb-4">
            @foreach ($active as $a)
                <div class="list-group-item">
                    <strong>{{ $a->gedung->nama }} - {{ $a->ruang->nama }}</strong><br>
                    Tanggal: {{ $a->tanggal }}<br>
                    Waktu: {{ $a->jam_mulai }} - {{ $a->jam_selesai }}

                    <div class="mt-1">
                        <span class="badge bg-warning">Pending</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


    <hr>

    <!-- RIWAYAT -->
    <h5>Riwayat Peminjaman</h5>

    @if ($riwayat->count() == 0)
        <p class="text-muted">Belum ada riwayat peminjaman.</p>
    @else
        <div class="list-group">
            @foreach ($riwayat as $r)
                <div class="list-group-item">

                    <strong>{{ $r->gedung->nama }} - {{ $r->ruang->nama }}</strong>
                    <br>
                    {{ $r->tanggal }} ({{ $r->jam_mulai }} → {{ $r->jam_selesai }})

                    <div class="mt-1">
                        @if ($r->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif ($r->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </div>

                    @if ($r->catatan)
                        <small class="text-muted d-block">Catatan: {{ $r->catatan }}</small>
                    @endif

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
