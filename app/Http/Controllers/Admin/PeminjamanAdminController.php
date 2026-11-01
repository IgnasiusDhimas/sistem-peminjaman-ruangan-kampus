<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanAdminController extends Controller
{
    /**
     * List semua peminjaman
     */
    public function index()
    {
        $data = Peminjaman::with(['user', 'gedung', 'ruang'])
        ->orderBy('tanggal', 'desc')
        ->orderBy('jam_mulai', 'asc')
        ->paginate(10);

        // Statistik dari SEMUA data (tanpa pagination)
        $total = Peminjaman::count();
        $pending = Peminjaman::where('status', 'pending')->count();
        $approved = Peminjaman::where('status', 'approved')->count();
        $rejected = Peminjaman::where('status', 'rejected')->count();

        return view('admin.peminjaman.index', compact('data', 'total', 'pending', 'approved', 'rejected'));
    }

    /**
     * Halaman detail
     */
    public function detail($id)
    {
        $p = Peminjaman::with(['user', 'gedung', 'ruang'])
            ->findOrFail($id);

        return view('admin.peminjaman.detail', compact('p'));
    }

    /**
     * Cek bentrok jadwal
     */
    private function isBentrok(Peminjaman $peminjaman)
    {
        return Peminjaman::where('ruang_id', $peminjaman->ruang_id)
            ->where('tanggal', $peminjaman->tanggal)
            ->where('id', '!=', $peminjaman->id)
            ->where(function($q) use ($peminjaman) {
                $q->whereBetween('jam_mulai', [$peminjaman->jam_mulai, $peminjaman->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$peminjaman->jam_mulai, $peminjaman->jam_selesai])
                  ->orWhere(function($q2) use ($peminjaman) {
                      $q2->where('jam_mulai', '<=', $peminjaman->jam_mulai)
                         ->where('jam_selesai', '>=', $peminjaman->jam_selesai);
                  });
            })
            ->exists();
    }

    /**
     * Admin menyetujui peminjaman
     */
    public function approve($id)
    {
        $p = Peminjaman::findOrFail($id);

        if ($p->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya!');
        }

        if ($this->isBentrok($p)) {
            return back()->with('error', 'Jadwal bentrok dengan peminjaman lain!');
        }

        $p->status = 'approved';
        $p->save();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui!');
    }

    /**
     * Admin menolak peminjaman
     */
    public function reject($id)
    {
        $p = Peminjaman::findOrFail($id);

        if ($p->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya!');
        }

        $p->status = 'rejected';
        $p->save();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman telah ditolak.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function create()
    {
        $gedung = \App\Models\Gedung::all();
        $users = \App\Models\User::all(); // admin bisa pilih siapa user yang meminjam

        return view('admin.peminjaman.create', compact('gedung','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'gedung_id'   => 'required|exists:gedungs,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan'   => 'nullable|string',
        ], [
            'tanggal.after_or_equal' => 'Tanggal peminjaman tidak boleh tanggal yang sudah lewat.',
            'jam_selesai.after'      => 'Jam selesai harus lebih besar dari jam mulai.',
        ]);

        // ✅ Validasi waktu mulai tidak boleh lewat (gabungkan tanggal + jam)
        $waktuMulaiStr = $request->tanggal . ' ' . $request->jam_mulai;
        try {
            $waktuMulai = new \DateTime($waktuMulaiStr);
            $sekarang   = new \DateTime();

            if ($waktuMulai < $sekarang) {
                return back()
                    ->withErrors(['jam_mulai' => 'Jam mulai tidak boleh kurang dari waktu sekarang (' . now()->format('H:i') . ').'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors(['jam_mulai' => 'Format tanggal atau jam tidak valid.'])
                ->withInput();
        }

        // Ambil user agar dapat email-nya
        $user = \App\Models\User::findOrFail($request->user_id);

        // Cek bentrok
        if ($this->isBentrok(new \App\Models\Peminjaman($request->all()))) {
            return back()->withErrors(['ruang_id' => 'Jadwal bentrok dengan peminjaman lain!'])->withInput();
        }

        Peminjaman::create([
            'user_id'     => $request->user_id,
            'email_user'  => $user->email,
            'gedung_id'   => $request->gedung_id,
            'ruang_id'    => $request->ruang_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan'   => $request->keperluan,
            'catatan'     => $request->catatan,
            'status'      => 'approved', // admin otomatis approve
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibuat.');
    }

    public function edit($id)
    {
        $p = Peminjaman::findOrFail($id);
        $gedung = \App\Models\Gedung::all();
        $users = \App\Models\User::all();
        $ruang = \App\Models\Ruang::where('gedung_id', $p->gedung_id)->get();

        return view('admin.peminjaman.edit', compact('p','gedung','ruang','users'));
    }

    public function update(Request $request, $id)
    {
        $p = Peminjaman::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'gedung_id' => 'required',
            'ruang_id' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keperluan' => 'nullable|string',
        ]);

        // cek bentrok
        $cek = Peminjaman::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where('id', '!=', $p->id)
            ->where(function($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhere(function($q2) use ($request) {
                    $q2->where('jam_mulai', '<=', $request->jam_mulai)
                        ->where('jam_selesai', '>=', $request->jam_selesai);
                });
            })
            ->exists();

        if ($cek) {
            return back()->with('error', 'Jadwal bentrok!');
        }

        $p->update($request->all());

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate.');
    }

    public function getRuangan(Request $request)
    {
        return \App\Models\Ruang::where('gedung_id', $request->gedung_id)->get();
    }


}
