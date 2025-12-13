<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    // Menampilkan daftar SEMUA peminjaman untuk Admin
    public function index()
    {
        // Tampilkan booking terbaru dulu, beserta data user, room, peserta, dan tamu
        $bookings = Booking::with(['user', 'room', 'participants', 'guests'])
                    ->latest()
                    ->get();
                    
        return view('admin.bookings.index', compact('bookings'));
    }

    // Mengubah status peminjaman menjadi 'approved'
    public function updateStatus(Request $request, Booking $booking)
    {
        // Validasi input hanya boleh 'approved' atau 'rejected'
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        // Update status di database
        $booking->update([
            'status' => $request->status
        ]);

        // Redirect kembali dengan pesan
        $pesan = $request->status == 'approved' ? 'Peminjaman disetujui!' : 'Peminjaman ditolak.';
        
        return back()->with('success', $pesan);
    }
}