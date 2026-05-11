<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $balita = Anak::latest()->get();

        $search = $request->search;

        $balita = Anak::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('balita.data-balita', compact('balita', 'search'));
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
        // 1. Perbaiki aturan validasi di sini
        $request->validate([
            // Pakai digits:16 agar user wajib input 16 angka
            'nik' => 'required|digits:16|unique:balita,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date|before_or_equal:today',
            'nama_ortu' => 'required',
            'alamat' => 'required'
        ], [
            // Custom pesan error
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits'   => 'NIK harus berjumlah 16 digit angka.',
            'nik.unique'   => 'NIK ini sudah terdaftar, silakan masukkan NIK lain.',
            'tgl_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
        ]);

        // Jika lolos validasi, data akan disimpan
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
