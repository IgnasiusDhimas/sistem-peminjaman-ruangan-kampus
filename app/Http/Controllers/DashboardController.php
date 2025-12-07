<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard', [
            'totalGedung' => Gedung::count(),
            'totalRuang' => Ruang::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'totalUser' => User::count(),
            'pending' => Peminjaman::where('status', 'pending')->count(),
            'approved' => Peminjaman::where('status', 'approved')->count(),
            'rejected' => Peminjaman::where('status', 'rejected')->count(),
            'latest' => Peminjaman::with(['user','gedung','ruang'])
                        ->latest()->take(5)->get(),
        ]);
    }

    public function petugas()
{
    return view('petugas.dashboard', [
        'pending' => Peminjaman::where('status', 'pending')->count(),
        'approved' => Peminjaman::where('status', 'approved')->count(),
        'rejected' => Peminjaman::where('status', 'rejected')->count(),

        // Pending untuk tabel "menunggu verifikasi" - TETAP get()
        'menungguVerifikasi' => Peminjaman::with(['user','ruang.gedung'])
                ->where('status','pending')
                ->orderBy('tanggal')
                ->orderBy('jam_mulai')
                ->get(),

        // Semua peminjaman (untuk tabel bawah) - UBAH ke paginate()
        'semuaPeminjaman' => Peminjaman::with(['user','ruang.gedung'])
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->paginate(10), // <-- GANTI get() dengan paginate(10)
    ]);
}

    public function user()
    {
        $userId = auth()->id();

        return view('user.dashboard', [
            'riwayat' => Peminjaman::with(['gedung','ruang'])
                        ->where('user_id', $userId)
                        ->latest()->get(),
            'active' => Peminjaman::with(['gedung','ruang'])
                        ->where('user_id', $userId)
                        ->where('status', 'pending')
                        ->get(),
        ]);
    }
}
