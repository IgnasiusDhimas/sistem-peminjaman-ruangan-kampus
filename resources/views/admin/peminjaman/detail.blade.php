@extends('layouts.app')

@section('content')
<div class="container col-md-7">

    <h3>Detail Peminjaman</h3>
    <hr>

    <div class="card p-4 shadow-sm">

        <p><strong>Email:</strong> {{ $p->user->email }}</p>
        <p><strong>User:</strong> {{ $p->user->name }}</p>
        <p><strong>Gedung:</strong> {{ $p->ruang->gedung->nama }}</p>
        <p><strong>Ruangan:</strong> {{ $p->ruang->nama }}</p>

        <p><strong>Tanggal:</strong> {{ $p->tanggal }}</p>
        <p><strong>Waktu:</strong> {{ $p->jam_mulai }} – {{ $p->jam_selesai }}</p>

        <p><strong>Status:</strong>
            @if($p->status === 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
            @elseif($p->status === 'approved')
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-danger">Rejected</span>
            @endif
        </p>

        <p><strong>Keperluan:</strong> {{ $p->keperluan ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $p->catatan ?? '-' }}</p>

        <hr>

        @if ($p->status === 'pending')
        <div class="d-flex gap-2">

            <form method="POST" action="{{ route('admin.peminjaman.approve', $p->id) }}">
                @csrf
                <button class="btn btn-success">Setujui</button>
            </form>

            <form method="POST" action="{{ route('admin.peminjaman.reject', $p->id) }}">
                @csrf
                <button class="btn btn-danger">Tolak</button>
            </form>

            


        </div>
        @endif

        <form method="POST"
            action="{{ route('admin.peminjaman.delete', $p->id) }}"
            onsubmit="return confirm('Hapus peminjaman ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-3">Hapus Peminjaman</button>
        </form>
    </div>

</div>
<a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Kembali</a>

@endsection
