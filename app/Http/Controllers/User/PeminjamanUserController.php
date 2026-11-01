<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\Peminjaman;

class PeminjamanUserController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $data = Peminjaman::with(['gedung','ruang'])
                ->where('user_id', $userId)
                ->orderBy('tanggal', 'desc')
                ->get();

        return view('user.peminjaman.index', compact('data'));
    }

    public function create()
    {
        return view('user.peminjaman.create', [
            'gedungs' => Gedung::all()
        ]);
    }

    public function getRuangan(Request $request)
    {
        return Ruang::where('gedung_id', $request->gedung_id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id'   => 'required|exists:gedungs,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan'   => 'required|string|max:255',
            'catatan'     => 'nullable|string',
        ], [
            'tanggal.after_or_equal' => 'Tanggal peminjaman tidak boleh tanggal yang sudah lewat.',
            'jam_selesai.after'      => 'Jam selesai harus lebih besar dari jam mulai.',
            'jam_mulai.date_format'  => 'Format jam mulai tidak valid (gunakan HH:MM).',
            'jam_selesai.date_format'=> 'Format jam selesai tidak valid (gunakan HH:MM).',
        ]);

        // ✅ Validasi tambahan: jika tanggal = hari ini, jam_mulai tidak boleh sebelum jam sekarang
        $waktuMulai = \Carbon\Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal . ' ' . $request->jam_mulai
        );

        if ($waktuMulai->isPast()) {
            return back()
                ->withErrors(['jam_mulai' => 'Jam mulai tidak boleh kurang dari waktu sekarang (' . now()->format('H:i') . ').'])
                ->withInput();
        }

        // Cek ruangan bentrok (TETAP seperti sebelumnya)
        $bentrok = Peminjaman::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhere(function ($q2) use ($request) {
                    $q2->where('jam_mulai', '<=', $request->jam_mulai)
                        ->where('jam_selesai', '>=', $request->jam_selesai);
                });
            })
            ->exists();

        if ($bentrok) {
            return back()->withErrors([
                'ruang_id' => 'Ruangan sudah dipakai pada waktu tersebut!'
            ])->withInput();
        }

        // Ambil user agar dapat email-nya
        $user = auth()->user();

        // Simpan peminjaman
        Peminjaman::create([
            'user_id'     => auth()->id(),
            'email_user'  => $user->email,
            'gedung_id'   => $request->gedung_id,
            'ruang_id'    => $request->ruang_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan'   => $request->keperluan,
            'catatan'     => $request->catatan,
        ]);

        return redirect()->route('user.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
}
