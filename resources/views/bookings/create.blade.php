<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Breadcrumb Simple --}}
            <nav class="flex mb-5 text-gray-500 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-800">Formulir Peminjaman</span>
            </nav>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl grid grid-cols-1 md:grid-cols-3 border border-gray-100">
                
                {{-- Kolom Kiri: Info Ruangan (Visual) --}}
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-8 text-white md:col-span-1 flex flex-col justify-between relative overflow-hidden">
                    {{-- Dekorasi Background --}}
                    <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 rounded-full bg-white opacity-10"></div>
                    <div class="absolute bottom-0 left-0 -ml-4 -mb-4 w-32 h-32 rounded-full bg-white opacity-10"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2 tracking-tight">Detail Ruangan</h3>
                        <div class="w-12 h-1 bg-indigo-400 mb-8 rounded-full"></div>
                        
                        <div class="space-y-6">
                            <div>
                                <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Nama Ruangan</p>
                                <p class="text-xl font-semibold">{{ $room->name }}</p>
                                <p class="text-indigo-300 text-sm font-mono bg-indigo-900/30 inline-block px-2 py-0.5 rounded mt-1">{{ $room->room_code }}</p>
                            </div>

                            <div>
                                <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Kapasitas</p>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <p class="text-lg">{{ $room->capacity }} Orang</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Fasilitas</p>
                                <p class="text-sm text-indigo-100 mt-1 leading-relaxed">{{ $room->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 text-xs text-indigo-200 border-t border-indigo-500/30 pt-4">
                        *Pastikan jadwal tidak bentrok dengan kegiatan lain yang sudah disetujui.
                    </div>
                </div>

                {{-- Kolom Kanan: Form Input --}}
                <div class="p-8 md:col-span-2 bg-white">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lengkapi Data Peminjaman</h2>

                    {{-- Alert Error --}}
                    @if ($errors->has('booking_conflict'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg animate-pulse">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700 font-bold">
                                        Gagal! {{ $errors->first('booking_conflict') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('user.bookings.store') }}" method="POST" class="space-y-6" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div>
                            <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Peminjaman</label>
                            <input type="text" name="purpose" id="purpose" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 placeholder-gray-400" placeholder="Contoh: Rapat Himpunan Mahasiswa" value="{{ old('purpose') }}" required>
                            @error('purpose') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                                <input type="datetime-local" name="start_time" id="start_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-pointer" value="{{ old('start_time') }}" required>
                                @error('start_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                                <input type="datetime-local" name="end_time" id="end_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-pointer" value="{{ old('end_time') }}" required>
                                @error('end_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition">Batal</a>
                            
                            <button type="submit" 
                                    :disabled="submitting"
                                    :class="{ 'opacity-75 cursor-not-allowed': submitting }"
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium shadow-md flex items-center transition transform active:scale-95">
                                
                                {{-- Spinner Icon --}}
                                <svg x-show="submitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                
                                <span x-text="submitting ? 'Memproses...' : 'Kirim Pengajuan'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>