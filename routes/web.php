<?php

use App\Models\Room;
use App\Models\Booking;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminUserController; // <-- Pastikan ini di-import
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Group untuk User Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Group untuk ADMIN
// PERBAIKAN: Menambahkan ->name('admin.') agar semua route di dalamnya otomatis punya awalan 'admin.'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalRooms = \App\Models\Room::count();
        $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
        $approvedBookings = \App\Models\Booking::where('status', 'approved')->count();

        return view('admin.dashboard', compact('totalRooms', 'pendingBookings', 'approvedBookings'));
    })->name('dashboard'); // Hasil akhir: admin.dashboard

    // Route Resource (CRUD)
    // Hapus ->names() manual karena sudah ada di group
    Route::resource('rooms', AdminRoomController::class); // Hasil akhir: admin.rooms.index
    
    // PERBAIKAN: Hapus duplikasi, cukup satu baris ini
    Route::resource('users', AdminUserController::class); // Hasil akhir: admin.users.index

    // Route Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::patch('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    
    // Route untuk Update Status (Terima/Tolak)
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
        ->name('bookings.updateStatus');
});

// Group untuk MAHASISWA / User Biasa
Route::middleware(['auth', 'verified', 'nim.filled'])->group(function () {
    Route::post('/bookings/{booking}/broadcast', [UserBookingController::class, 'broadcast'])->name('user.bookings.broadcast');
    Route::get('/bookings/create/{room}', [UserBookingController::class, 'create'])->name('user.bookings.create');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('user.bookings.store');
    Route::get('/my-bookings', [UserBookingController::class, 'index'])->name('user.bookings.index');
});

require __DIR__.'/auth.php';