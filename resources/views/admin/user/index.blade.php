@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Kelola User</h1>

    <a href="{{ route('admin.user.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded-md mb-4 inline-block hover:bg-blue-700">
       Tambah User
    </a>

    <div class="bg-white shadow rounded-lg p-4">

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Nama</th>
                    <th class="text-left p-2">Email</th>
                    <th class="text-left p-2">Role</th>
                    <th class="text-left p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr class="border-b">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2 capitalize">{{ $user->role }}</td>
                    <td class="p-2 flex gap-2">

                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                           Edit
                        </a>

                        <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Hapus user ini?')"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>

</div>
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>

@endsection
