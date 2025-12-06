@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

        <div class="bg-blue-600 text-white p-4 rounded-lg">
            <p class="text-sm opacity-70">Total Gedung</p>
            <h2 class="text-2xl font-bold">{{ $totalGedung }}</h2>
        </div>

        <div class="bg-yellow-600 text-white p-4 rounded-lg">
            <p class="text-sm opacity-70">Total Ruangan</p>
            <h2 class="text-2xl font-bold">{{ $totalRuang }}</h2>
        </div>

        <div class="bg-green-600 text-white p-4 rounded-lg">
            <p class="text-sm opacity-70">Total Peminjaman</p>
            <h2 class="text-2xl font-bold">{{ $totalPeminjaman }}</h2>
        </div>

        {{-- Statistik Baru: Total User --}}
        <div class="bg-purple-600 text-white p-4 rounded-lg">
            <p class="text-sm opacity-70">Total User</p>
            <h2 class="text-2xl font-bold">{{ $totalUser }}</h2>
        </div>

        <div class="bg-red-600 text-white p-4 rounded-lg">
            <p class="text-sm opacity-70">Pending Approve</p>
            <h2 class="text-2xl font-bold">{{ $pending }}</h2>
        </div>
    </div>

    {{-- Shortcut Menu --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <a href="{{ route('admin.peminjaman.index') }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100">
            <h3 class="font-semibold">Kelola Peminjaman</h3>
            <p class="text-sm text-gray-600">Approve / Reject permohonan</p>
        </a>

        <a href="{{ route('admin.gedung.index') }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100">
            <h3 class="font-semibold">Kelola Gedung</h3>
            <p class="text-sm text-gray-600">Tambah & edit data gedung</p>
        </a>

        <a href="{{ route('admin.ruang.index') }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100">
            <h3 class="font-semibold">Kelola Ruangan</h3>
            <p class="text-sm text-gray-600">Atur ruangan per gedung</p>
        </a>

        <a href="{{ route('admin.user.index') }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100">
            <h3 class="font-semibold">Kelola User</h3>
            <p class="text-sm text-gray-600">Tambah, hapus, dan edit user</p>
        </a>

    </div>

    {{-- Peminjaman Terbaru --}}
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="font-semibold mb-3">Peminjaman Terbaru</h3>

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Email</th>
                    <th class="text-left p-2">User</th>
                    <th class="text-left p-2">Ruangan</th>
                    <th class="text-left p-2">Tanggal</th>
                    <th class="text-left p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest as $item)
                <tr class="border-b">
                    <td class="p-2">{{ $item->user->email }}</td>
                    <td class="p-2">{{ $item->user->name }}</td>
                    <td class="p-2">{{ $item->gedung->nama }} - {{ $item->ruang->nama }}</td>
                    <td class="p-2">{{ $item->tanggal }}</td>
                    <td class="p-2 capitalize">{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
