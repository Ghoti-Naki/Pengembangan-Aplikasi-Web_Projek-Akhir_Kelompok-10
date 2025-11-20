<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureNimIsFilled
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Cek: Jika dia Mahasiswa DAN NIM-nya masih kosong/null
        if ($user->role === 'mahasiswa' && empty($user->nim)) {
            // Redirect ke halaman edit profile dengan pesan peringatan
            return redirect()->route('profile.edit')
                ->with('error', 'Eits! Anda wajib mengisi NIM di profil sebelum mengajukan peminjaman.');
        }

        return $next($request);
    }
}
