<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ket_kategori' => 'required|string|max:100|unique:kategoris,ket_kategori',
        ]);

        Kategori::create($validated);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $validated = $request->validate([
            'ket_kategori' => 'required|string|max:100|unique:kategoris,ket_kategori,' . $kategori->id_kategori . ',id_kategori',
        ]);

        $kategori->update($validated);

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}