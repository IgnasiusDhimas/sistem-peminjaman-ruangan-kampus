<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::with('gedung')->get();
        return view('admin.ruang.index', compact('ruangs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.ruang.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required',
            'nama'      => 'required',
            'kapasitas' => 'required|integer',
        ]);

        Ruang::create([
            'gedung_id' => $request->gedung_id,
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('admin.ruang.index')
                         ->with('success', 'Ruang berhasil ditambah.');
    }

    public function edit(Ruang $ruang)
    {
        $gedungs = Gedung::all();
        return view('admin.ruang.edit', compact('ruang', 'gedungs'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'gedung_id' => 'required',
            'nama'      => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $ruang->update([
            'gedung_id' => $request->gedung_id,
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('admin.ruang.index')
                         ->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        $ruang->delete();

        return redirect()->route('admin.ruang.index')
                         ->with('success', 'Ruang berhasil dihapus.');
    }
}
