<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Breadcrumb Simple --}}
            <nav class="flex mb-5 text-gray-500 text-sm">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">Formulir Peminjaman</span>
            </nav>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl grid grid-cols-1 md:grid-cols-3">
                
                {{-- Kolom Kiri: Info Ruangan (Visual) --}}
                <div class="bg-indigo-600 p-8 text-white md:col-span-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Detail Ruangan</h3>
                        <div class="w-16 h-1 bg-indigo-400 mb-6"></div>
                        
                        <div class="mb-6">
                            <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Nama Ruangan</p>
                            <p class="text-xl font-semibold">{{ $room->name }}</p>
                            <p class="text-indigo-300 text-sm">{{ $room->room_code }}</p>
                        </div>

                        <div class="mb-6">
                            <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Kapasitas</p>
                            <p class="text-lg">{{ $room->capacity }} Orang</p>
                        </div>

                        <div>
                            <p class="text-indigo-200 text-xs uppercase tracking-wider font-bold">Fasilitas</p>
                            <p class="text-sm text-indigo-100 mt-1">{{ $room->description }}</p>
                        </div>
                    </div>
                    <div class="mt-8 text-sm text-indigo-200">
                        *Pastikan jadwal tidak bentrok dengan kegiatan lain.
                    </div>
                </div>

                {{-- Kolom Kanan: Form Input --}}
                <div class="p-8 md:col-span-2 bg-white">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lengkapi Data Peminjaman</h2>

                    {{-- Alert Error --}}
                    @if ($errors->has('booking_conflict'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700 font-medium">
                                        {{ $errors->first('booking_conflict') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('user.bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div>
                            <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Peminjaman</label>
                            <input type="text" name="purpose" id="purpose" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150" placeholder="Contoh: Rapat Himpunan Mahasiswa" value="{{ old('purpose') }}" required>
                            @error('purpose') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                                <input type="datetime-local" name="start_time" id="start_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('start_time') }}" required>
                                @error('start_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                                <input type="datetime-local" name="end_time" id="end_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('end_time') }}" required>
                                @error('end_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium shadow-md transition transform hover:-translate-y-0.5">
                                Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>