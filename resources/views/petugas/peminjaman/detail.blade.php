@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Detail Peminjaman</h3>
    <hr>

    <div class="card p-3">
        <p><strong>Nama Peminjam:</strong> {{ $p->user->name }}</p>
        <p><strong>Email:</strong> {{ $p->user->email }}</p>
        <p><strong>Gedung:</strong> {{ $p->ruang->gedung->nama }}</p>
        <p><strong>Ruangan:</strong> {{ $p->ruang->nama }}</p>

        <p><strong>Tanggal:</strong> {{ $p->tanggal }}</p>
        <p><strong>Jam:</strong> {{ $p->jam_mulai }} - {{ $p->jam_selesai }}</p>

        <p><strong>Keperluan:</strong><br>{{ $p->keperluan }}</p>

        <p><strong>Status:</strong>
            @if ($p->status === 'pending')
                <span class="badge bg-warning">Pending</span>
            @elseif ($p->status === 'approved')
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-danger">Rejected</span>
            @endif
        </p>

        <div class="mt-3">

            @if ($p->status === 'pending')

                {{-- APPROVE --}}
                <form action="{{ route('petugas.peminjaman.approve', $p->id) }}"
                      method="POST"
                      style="display:inline-block;">
                    @csrf
                    <button type="submit"
                            class="btn btn-success"
                            onclick="return confirm('Setujui peminjaman ini?')">
                        Setujui
                    </button>
                </form>

                {{-- REJECT --}}
                <form action="{{ route('petugas.peminjaman.reject', $p->id) }}"
                      method="POST"
                      style="display:inline-block;">
                    @csrf
                    <button type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Tolak peminjaman ini?')">
                        Tolak
                    </button>
                </form>

            @endif

            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>
@endsection
