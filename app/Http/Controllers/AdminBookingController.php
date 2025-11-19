<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    // Menampilkan daftar SEMUA peminjaman untuk Admin
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])
                          ->orderBy('created_at', 'desc')
                          ->get();
                          
        return view('admin.bookings.index', compact('bookings'));
    }

    // Mengubah status peminjaman menjadi 'approved'
    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // Mengubah status peminjaman menjadi 'rejected'
    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }
}