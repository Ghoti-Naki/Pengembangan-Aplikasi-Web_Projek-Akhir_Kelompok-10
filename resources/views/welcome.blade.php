<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SpaceFlow - Campus Booking System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    
    {{-- Navbar Transparan --}}
    <nav class="absolute w-full z-20 top-0 left-0 border-b border-gray-200/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-2xl text-indigo-600">SpaceFlow</span>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                Kelola Peminjaman Ruangan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Tanpa Bentrok Jadwal</span>
            </h1>
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto mb-10">
                SpaceFlow membantu mahasiswa dan dosen meminjam ruangan kampus dengan mudah, cepat, dan terorganisir. Cek ketersediaan secara real-time.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-full shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1">
                    Mulai Peminjaman
                </a>
                <a href="#features" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-full shadow-md border border-gray-200 hover:bg-gray-50 transition">
                    Pelajari Fitur
                </a>
            </div>
        </div>
        
        {{-- Dekorasi Background --}}
        <div class="absolute top-0 left-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-4 text-2xl">🚀</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Proses Cepat</h3>
                    <p class="text-gray-600">Ajukan peminjaman hanya dalam beberapa klik. Status pengajuan dapat dipantau langsung dari dashboard.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4 text-2xl">🛡️</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Anti Bentrok</h3>
                    <p class="text-gray-600">Sistem cerdas kami otomatis mendeteksi dan mencegah jadwal ganda pada ruangan yang sama.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4 text-2xl">📊</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manajemen Mudah</h3>
                    <p class="text-gray-600">Admin memiliki kontrol penuh untuk menyetujui atau menolak pengajuan dengan dashboard yang intuitif.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2025 SpaceFlow. Project Akhir Praktikum PAW.</p>
            <p class="text-gray-500 text-sm mt-2">Dibuat dengan Laravel 11 & Tailwind CSS</p>
        </div>
    </footer>
</body>
</html>