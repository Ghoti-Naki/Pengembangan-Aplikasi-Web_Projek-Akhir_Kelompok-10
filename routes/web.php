<?php

use App\Models\Room;
use App\Models\Booking;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $totalRooms = Room::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();

        return view('admin.dashboard', compact('totalRooms', 'pendingBookings', 'approvedBookings'));
    })->name('admin.dashboard');

    Route::resource('rooms', AdminRoomController::class)->names('admin.rooms');

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('admin.bookings.approve');
    Route::patch('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/bookings/create/{room}', [UserBookingController::class, 'create'])->name('user.bookings.create');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('user.bookings.store');
    Route::get('/my-bookings', [UserBookingController::class, 'index'])->name('user.bookings.index');
});

require __DIR__.'/auth.php';
