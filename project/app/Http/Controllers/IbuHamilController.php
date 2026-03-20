<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index()
    {
        $ibu_hamil = IbuHamil::latest()->get();
        return view('ibu_hamil.data-ibuhamil', compact('ibu_hamil'));
    }

        public function create()
    {
        return view('ibu_hamil.create');
    }

    public function store(Request $request)
    {
        IbuHamil::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('ibu_hamil.index')->with('success','Data berhasil ditambahkan');
    }

        public function edit($id)
    {
        $ibu_hamil = IbuHamil::findOrFail($id);
        return view('ibu_hamil.edit', compact('ibu_hamil'));
    }

    public function update(Request $request, $id)
    {
        $ibu_hamil = IbuHamil::findOrFail($id);

        $ibu_hamil->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('ibu_hamil.index')->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $ibu_hamil = IbuHamil::findOrFail($id);
        $ibu_hamil->delete();

        return redirect()->route('ibu_hamil.index')->with('success','Data berhasil dihapus');
    }
}
