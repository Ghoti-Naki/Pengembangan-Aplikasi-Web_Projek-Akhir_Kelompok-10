<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SpaceFlow') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            
            {{-- Kolom Kiri: Gambar Artistik (Hidden di HP) --}}
            <div class="hidden lg:flex w-1/2 bg-indigo-900 items-center justify-center relative overflow-hidden">
                {{-- Background Image --}}
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop" 
                     alt="Office" class="absolute inset-0 w-full h-full object-cover opacity-40">
                
                <div class="relative z-10 text-center px-10">
                    <h1 class="text-5xl font-bold text-white mb-4 tracking-tight">SpaceFlow</h1>
                    <p class="text-indigo-200 text-xl">Sistem Manajemen Ruangan Kampus<br>Terintegrasi & Modern.</p>
                </div>
                
                {{-- Dekorasi Circle --}}
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            </div>

            {{-- Kolom Kanan: Form --}}
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8">
                <div class="w-full max-w-md space-y-8">
                    <div class="text-center lg:hidden">
                        <h2 class="text-3xl font-extrabold text-gray-900">SpaceFlow</h2>
                    </div>

                    {{-- Slot untuk Form Login/Register --}}
                    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-100">
                        {{ $slot }}
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SpaceFlow Project.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>