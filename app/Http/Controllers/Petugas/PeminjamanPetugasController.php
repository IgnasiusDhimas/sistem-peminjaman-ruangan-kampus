<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanPetugasController extends Controller
{
    /**
     * Daftar peminjaman pending
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'ruang.gedung'])
            ->where('status', 'pending')
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Detail peminjaman
     */
    public function detail($id)
    {
        $p = Peminjaman::with(['user', 'ruang.gedung'])->findOrFail($id);

        return view('petugas.peminjaman.detail', compact('p'));
    }

    /**
     * Approve
     */
    public function approve($id)
    {
        $p = Peminjaman::findOrFail($id);

        if ($p->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        if ($this->isBentrok($p)) {
            return back()->with('error', 'Ruangan bentrok pada jam tersebut.');
        }

        $p->update(['status' => 'approved']);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Peminjaman disetujui.');
    }

    /**
     * Reject
     */
    public function reject($id)
    {
        $p = Peminjaman::findOrFail($id);

        if ($p->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        $p->update(['status' => 'rejected']);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Peminjaman ditolak.');
    }

    /**
     * Form create
     */
    public function create()
    {
        $gedung = Gedung::all();
        $ruangan = Ruang::all();
        $users = User::where('role', 'user')->get();

        return view('petugas.peminjaman.create', compact('gedung', 'ruangan', 'users'));
    }

    /**
     * Store peminjaman buatan petugas
     */
    public function store(Request $request)
    {
        $request->validate([
            'gedung_id'   => 'required|exists:gedungs,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan'   => 'required|string',
        ]);

        // Dummy model untuk cek bentrok
        $dummy = new Peminjaman([
            'ruang_id'    => $request->ruang_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        if ($this->isBentrok($dummy)) {
            return back()->with('error', 'Ruangan bentrok pada jam tersebut!');
        }
        // ambil user agar dapat email-nya
        $user = auth()->user(); 


        Peminjaman::create([
            'user_id'    => Auth::id(), // petugas sebagai pembuat
            'email_user'  => $user->email,
            'ruang_id'   => $request->ruang_id,
            'tanggal'    => $request->tanggal,
            'jam_mulai'  => $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
            'keperluan'  => $request->keperluan,
            'gedung_id' => $request->gedung_id,
            'catatan' => $request->catatan,
            'status'     => 'approved', // otomatis disetujui
        ]);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibuat.');
    }

    /**
     * Cek bentrok jadwal
     */
    private function isBentrok(Peminjaman $p)
    {
        return Peminjaman::where('ruang_id', $p->ruang_id)
            ->where('tanggal', $p->tanggal)
            ->where('status', 'approved')
            ->where(function ($q) use ($p) {
                $q->whereBetween('jam_mulai', [$p->jam_mulai, $p->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$p->jam_mulai, $p->jam_selesai])
                  ->orWhere(function ($query) use ($p) {
                      $query->where('jam_mulai', '<=', $p->jam_mulai)
                            ->where('jam_selesai', '>=', $p->jam_selesai);
                  });
            })
            ->exists();
    }
}
