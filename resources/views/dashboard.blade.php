<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-indigo-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl">
                Temukan Ruangan Sempurna untuk Kegiatanmu
            </h1>
            <p class="mt-4 text-xl text-indigo-100">
                Jadwal terpusat, anti-bentrok, dan mudah diakses.
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-end mb-6 px-2">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Ruangan</h2>
                    <p class="text-gray-500 text-sm">Pilih ruangan yang tersedia di bawah ini.</p>
                </div>
            </div>

            @if ($rooms->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <p class="mt-2 text-lg font-medium text-gray-900">Belum ada ruangan</p>
                    <p class="text-gray-500">Admin belum menambahkan data ruangan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($rooms as $room)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full border border-gray-100">
                            
                            {{-- Gambar Ruangan (Placeholder Keren) --}}
                            <div class="h-48 w-full bg-gray-200 relative">
                                @if($room->image)
                                    <img src="{{ Storage::url('rooms/'.$room->image) }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                                @else
                                    {{-- Gambar Random Unsplash (Biar terlihat hidup) --}}
                                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80" alt="Room Placeholder" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-sm">
                                    {{ $room->room_code }}
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 truncate" title="{{ $room->name }}">{{ $room->name }}</h3>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    {{-- Icon User --}}
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Kapasitas: <span class="font-semibold text-gray-700 ml-1">{{ $room->capacity }} Orang</span>
                                </div>

                                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                                    {{ $room->description }}
                                </p>

                                <a href="{{ route('user.bookings.create', $room->id) }}" class="w-full block text-center bg-indigo-600 text-white font-medium py-2.5 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200 focus:ring-4 focus:ring-indigo-200">
                                    Ajukan Peminjaman
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>