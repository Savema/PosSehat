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
        $anak = Anak::latest()->get();
        return view('balita.data-balita', compact('anak'));
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
        $request->validate([
        'nik' => 'required|unique:anak',
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
    ]);

        Anak::create($request->all());

        return redirect()->route('balita.data-balita')
            ->with('success', 'Data balita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        return view('balita.edit', compact('anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak)
    {
        $request->validate([
            'nik' => 'required|unique:anak,nik,' . $anak->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $anak->update($request->all());

        return redirect()->route('balita.data-balita')
            ->with('success', 'Data balita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $anak->delete();

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil dihapus');
    }
}
