@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Peminjaman</h3>
        <a href="{{ route('user.peminjaman.create') }}" class="btn btn-primary">+ Ajukan Peminjaman</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($data->count() == 0)
        <p class="text-muted">Belum ada peminjaman.</p>
    @else
        <div class="list-group">
            @foreach ($data as $p)
                <div class="list-group-item">

                    <strong>{{ $p->gedung->nama }} - {{ $p->ruang->nama }}</strong>
                    <br>
                    {{ $p->tanggal }} ({{ $p->jam_mulai }} → {{ $p->jam_selesai }})

                    <div class="mt-2">
                        @if ($p->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif ($p->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </div>

                    @if ($p->catatan)
                        <small class="text-muted d-block">Catatan: {{ $p->catatan }}</small>
                    @endif

                </div>
            @endforeach
        </div>
    @endif

</div>
<a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                Kembali
</a>
@endsection
