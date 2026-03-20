<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balita = Anak::latest()->get();
        return view('balita.data-balita', compact('balita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('balita.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Anak::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ortu' => $request->nama_ortu,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('balita.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $balita = Anak::findOrFail($id);
        return view('balita.edit', compact('balita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $balita = Anak::findOrFail($id);

        $balita->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ortu' => $request->nama_ortu,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('balita.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $balita = Anak::findOrFail($id);
        $balita->delete();

        return redirect()->route('balita.index')->with('success','Data berhasil dihapus');
    }
}
