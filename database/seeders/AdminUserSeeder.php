<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Admin Petugas',
            'nim' => '999999999', // NIM dummy atau kode petugas
            'email' => 'admin@spaceflow.com',
            'password' => Hash::make('password'), // Password: password
            'role' => 'admin', // ROLE KHUSUS ADMIN
        ]);
    }
}
