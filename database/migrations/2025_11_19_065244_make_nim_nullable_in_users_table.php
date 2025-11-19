<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom 'nim' menjadi dapat diisi NULL (opsional)
            $table->string('nim')->nullable()->unique(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan 'nim' ke kondisi NOT NULL (Jika diperlukan rollback)
            $table->string('nim')->nullable(false)->unique()->change(); 
        });
    }
};
