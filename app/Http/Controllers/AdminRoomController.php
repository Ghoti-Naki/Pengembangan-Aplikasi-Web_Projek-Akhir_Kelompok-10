<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    // Mengambil dan menampilkan semua ruangan
    public function index()
    {
        $rooms = Room::orderBy('room_code')->get();
        // Mengarahkan ke view admin/rooms/index.blade.php
        return view('admin.rooms.index', compact('rooms')); 
    }

    // Menampilkan formulir tambah ruangan
    public function create()
    {
        // Mengarahkan ke view admin/rooms/create.blade.php
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validated = $request->validate([
            'room_code' => 'required|string|unique:rooms,room_code', // Harus unik
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Jika ada upload gambar
        ]);

        // 2. Proses Upload Gambar (Jika ada)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/rooms');
            $validated['image'] = basename($path); // Simpan hanya nama filenya
        }

        // 3. Simpan ke Database
        Room::create($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan baru berhasil ditambahkan.');
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
    public function edit(Room $room)
    {
        // Mengirim objek $room ke view edit
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            // Pastikan unique:rooms mengabaikan ruangan saat ini
            'room_code' => 'required|string|unique:rooms,room_code,'.$room->id, 
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Proses Upload/Update Gambar (jika ada file baru)
        if ($request->hasFile('image')) {
            // Logika tambahan: Hapus gambar lama jika ada
            // Storage::delete('public/rooms/' . $room->image); 

            $path = $request->file('image')->store('public/rooms');
            $validated['image'] = basename($path);
        }

        // Update data di database
        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Hapus ruangan dari database
        $room->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}
