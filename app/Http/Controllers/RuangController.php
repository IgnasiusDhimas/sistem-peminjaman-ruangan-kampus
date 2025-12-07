<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index(Request $request)
{
    $query = Ruang::with('gedung');
    
    // Filter by gedung
    if ($request->has('gedung_id') && $request->gedung_id) {
        $query->where('gedung_id', $request->gedung_id);
    }
    
    // Sorting
    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'nama_desc':
                $query->orderBy('nama', 'desc');
                break;
            case 'kapasitas_asc':
                $query->orderBy('kapasitas', 'asc');
                break;
            case 'kapasitas_desc':
                $query->orderBy('kapasitas', 'desc');
                break;
            default: // nama_asc
                $query->orderBy('nama', 'asc');
        }
    } else {
        $query->orderBy('nama', 'asc');
    }
    
    $ruangs = $query->get();
    $gedungs = Gedung::all(); // Untuk dropdown filter
    
    return view('admin.ruang.index', compact('ruangs', 'gedungs'));
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
