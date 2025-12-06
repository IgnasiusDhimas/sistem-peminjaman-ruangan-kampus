@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Manajemen Peminjaman Ruangan (Admin)</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-success mb-3">
        + Tambah Peminjaman
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Gedung / Ruang</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $p)
                    <tr>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->ruang->gedung->nama }} / {{ $p->ruang->nama }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>

                        <td>
                            @if($p->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>

                       <td class="d-flex gap-1">

    {{-- Detail --}}
    <a href="{{ route('admin.peminjaman.detail', $p->id) }}"
       class="btn btn-sm btn-primary">Detail</a>

    <a href="{{ route('admin.peminjaman.edit', $p->id) }}" class="btn btn-sm btn-warning">
        Edit
    </a>


    {{-- Delete --}}
    <form action="{{ route('admin.peminjaman.delete', $p->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
    </form>


</td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>

@endsection
