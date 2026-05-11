<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $user = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('users.users', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Tambahkan validasi ini
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'nama' => 'required',
            'no_hp' => 'required',
            'password' => 'required|min:8',
            'role' => 'required'
        ], [
            // Custom pesan error (opsional)
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain.',
        ]);

        User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'role' => $request->role

        ]);

        return redirect()->route('users.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success','Data berhasil dihapus');
    }
}
