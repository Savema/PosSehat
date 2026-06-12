<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $t_edukasi = Edukasi::query()
            ->when($search, function ($query) use ($search) {
                $query->where('kategori', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('edukasi.edukasi', compact('t_edukasi', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('edukasi.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('edukasi', 'public');
        } else {
            $gambar = null;
        }
        Edukasi::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'gambar' => $gambar
        ]);

        return redirect()->route('edukasi.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $t_edukasi = Edukasi::findOrFail($id);
        return view('edukasi.edit', compact('t_edukasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $t_edukasi = Edukasi::findOrFail($id);

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')->store('edukasi','public');

        } else {

            $gambar = $t_edukasi->gambar;

        }

        $t_edukasi->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'gambar' => $gambar
        ]);

        return redirect()->route('edukasi.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $t_edukasi = Edukasi::findOrFail($id);
        $t_edukasi->delete();

        return redirect()->route('edukasi.index')->with('success','Data berhasil dihapus');
    }
}
