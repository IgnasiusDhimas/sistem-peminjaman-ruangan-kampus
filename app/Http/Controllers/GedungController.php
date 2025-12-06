<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    // ADMIN: List semua gedung
    public function index()
    {
        $gedungs = Gedung::all();
        return view('admin.gedung.index', compact('gedungs'));
    }

    // ADMIN: Form tambah gedung
    public function create()
    {
        return view('admin.gedung.create');
    }

    // ADMIN: Simpan gedung
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi'=>'nullable'
        ]);

        Gedung::create([
            'nama' => $request->nama,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect()->route('admin.gedung.index')
                         ->with('success', 'Gedung berhasil ditambah.');
    }

    // ADMIN: Edit gedung
    public function edit(Gedung $gedung)
    {
        return view('admin.gedung.edit', compact('gedung'));
    }

    // ADMIN: Update gedung
    public function update(Request $request, Gedung $gedung)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi'=>'nullable'
        ]);

        $gedung->update([
            'nama' => $request->nama,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect()->route('admin.gedung.index')
                         ->with('success', 'Gedung berhasil diperbarui.');
    }

    // ADMIN: Hapus gedung
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();

        return redirect()->route('admin.gedung.index')
                         ->with('success', 'Gedung berhasil dihapus.');
    }
}
