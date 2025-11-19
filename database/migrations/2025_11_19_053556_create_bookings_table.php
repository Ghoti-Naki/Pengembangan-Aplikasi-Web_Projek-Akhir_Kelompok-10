<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke tabel users (PK: id)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Foreign Key ke tabel rooms (PK: id)
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');

            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('purpose');
            
            // Status peminjaman
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
