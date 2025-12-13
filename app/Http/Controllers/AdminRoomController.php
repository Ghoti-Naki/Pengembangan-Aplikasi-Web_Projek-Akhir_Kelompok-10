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
        return view('admin.rooms.index', compact('rooms')); 
    }

    // Menampilkan formulir tambah ruangan
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validated = $request->validate([
            'room_code' => 'required|string|unique:rooms,room_code',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Proses Upload Gambar (PERBAIKAN DISINI)
        if ($request->hasFile('image')) {
            // Gunakan parameter kedua 'public' agar masuk ke storage/app/public/rooms
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image'] = basename($path); 
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
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_code' => 'required|string|unique:rooms,room_code,'.$room->id, 
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Proses Upload/Update Gambar (PERBAIKAN DISINI)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada agar server tidak penuh
            if ($room->image) {
                Storage::disk('public')->delete('rooms/' . $room->image);
            }

            // Simpan gambar baru ke disk 'public'
            $path = $request->file('image')->store('rooms', 'public');
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
        // Hapus fisik gambar jika ada
        if ($room->image) {
            Storage::disk('public')->delete('rooms/' . $room->image);
        }

        // Hapus ruangan dari database
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}