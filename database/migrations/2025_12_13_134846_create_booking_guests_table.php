<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_guests', function (Blueprint $table) {
            $table->id();
            // Hubungkan dengan tabel bookings
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            
            // Kolom untuk data tamu eksternal
            $table->string('email'); 
            $table->string('name')->default('Tamu Undangan'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_guests');
    }
};