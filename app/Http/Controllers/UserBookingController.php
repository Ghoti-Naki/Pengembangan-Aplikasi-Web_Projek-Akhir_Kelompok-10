<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    // Method untuk menampilkan form booking
    public function create(Room $room)
    {
        // View form booking akan menerima objek $room
        return view('bookings.create', compact('room'));
    }

    // Method untuk memproses pengajuan booking
    public function store(Request $request)
    {
        // 1. Validasi Data Dasar
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string|max:255',
        ]);

        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);
        $roomId = $request->room_id;

        // 2. LOGIKA PENCEGAHAN DOUBLE BOOKING (Core Business Logic)
        $isConflict = Booking::where('room_id', $roomId)
            ->where('status', 'approved') // Hanya cek jadwal yang SUDAH DISETUJUI
            ->where(function ($query) use ($start, $end) {
                // Pengecekan tabrakan 4 skenario utama:
                // 1. Peminjaman baru mulai di tengah jadwal lama
                $query->where('start_time', '<', $end) 
                // 2. Peminjaman baru selesai di tengah jadwal lama
                      ->where('end_time', '>', $start); 
                // Jika kedua kondisi di atas terpenuhi, berarti ada tabrakan.
            })->exists();


        if ($isConflict) {
            // Jika ada tabrakan, kembalikan dengan error
            return back()->withErrors(['booking_conflict' => 'Maaf, ruangan ini sudah dipesan dan disetujui pada jam tersebut.'])->withInput();
        }

        // 3. Simpan Peminjaman Baru (Default status: pending)
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'start_time' => $start,
            'end_time' => $end,
            'purpose' => $request->purpose,
            'status' => 'pending', // Perlu persetujuan Admin
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim! Menunggu persetujuan Admin.');
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
                          ->with('room')
                          ->orderBy('start_time', 'desc')
                          ->get();

        return view('bookings.index', compact('bookings'));
    }
}
