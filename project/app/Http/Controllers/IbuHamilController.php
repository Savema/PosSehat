<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $ibu_hamil = IbuHamil::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('ibu_hamil.data-ibuhamil', compact('ibu_hamil', 'search'));
    }

        public function create()
    {
        return view('ibu_hamil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi NIK wajib 16 digit dan unik di tabel ibu_hamil
            'nik' => 'required|digits:16|unique:ibu_hamil,nik',
            'nama' => 'required',
            'tgl_lahir' => 'required|date|before_or_equal:today',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
        ], [
            // Custom pesan error agar ramah pengguna
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits'   => 'NIK harus tepat 16 digit angka.',
            'nik.unique'   => 'NIK ini sudah terdaftar dalam sistem.',
            'tgl_lahir.before_or_equal' => 'Tanggal lahir tidak valid (melebihi hari ini).',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        // Jika validasi lolos, proses simpan data
        IbuHamil::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('ibuhamil.index')->with('success', 'Data Ibu Hamil berhasil ditambahkan!');
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
