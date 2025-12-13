<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingGuest extends Model
{
    // Agar kolom ini bisa diisi (Mass Assignment)
    protected $fillable = ['booking_id', 'name', 'email'];
}