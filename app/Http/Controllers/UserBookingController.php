<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;   
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingInvitation;

class UserBookingController extends Controller
{
    // Method untuk menampilkan form booking
    public function create(Room $room)
    {
        // Ambil semua user kecuali diri sendiri
        $users = User::where('id', '!=', auth()->id())->get();
        return view('bookings.create', compact('room', 'users'));
        
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
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'purpose' => $request->purpose,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
        ]);

        // 3. Simpan Peserta Undangan
        // Sekarang variabel $booking sudah ada isinya, jadi kode ini akan jalan
        if ($request->has('participants')) {
            $booking->participants()->attach($request->participants);
        }

        if ($request->filled('external_guests')) {
            // Pecah teks berdasarkan koma
            $emails = explode(',', $request->external_guests);
            
            foreach ($emails as $email) {
                $email = trim($email); // Bersihkan spasi
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Cek apakah format email valid
                    \App\Models\BookingGuest::create([
                        'booking_id' => $booking->id,
                        'email'      => $email,
                        'name'       => 'Tamu Eksternal'
                    ]);
                }
            }
        }

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

    public function broadcast(Booking $booking)
    {
        // Cek otorisasi
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $count = 0;

        // 1. CEK & KIRIM KE PESERTA INTERNAL
        foreach ($booking->participants as $user) {
            if ($user->email) {
                Mail::to($user->email)->send(new BookingInvitation($booking));
                $count++;
            }
        }

        // 2. CEK & KIRIM KE TAMU EKSTERNAL (Pastikan bagian ini ada)
        foreach ($booking->guests as $guest) {
            if ($guest->email) {
                Mail::to($guest->email)->send(new BookingInvitation($booking));
                $count++;
            }
        }

        // Jika total count masih 0, berarti emang kosong
        if ($count == 0) {
            return back()->with('error', 'Tidak ada peserta atau email eksternal untuk diundang.');
        }

        return back()->with('success', 'Undangan Email berhasil dikirim ke ' . $count . ' orang!');
    }
}
