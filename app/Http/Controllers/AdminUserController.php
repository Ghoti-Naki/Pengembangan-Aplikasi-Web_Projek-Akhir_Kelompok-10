<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        // Ambil semua user selain admin yang sedang login
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'nullable|string|max:20', // Boleh kosong jika Dosen
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'role' => 'mahasiswa', // Default role (bisa diubah logicnya jika perlu)
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }
    
    // Fitur hapus user (Opsional)
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}