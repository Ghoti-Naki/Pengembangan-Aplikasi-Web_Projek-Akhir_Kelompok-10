<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Peminjaman: ') . $room->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Tampilkan Error Konflik --}}
                    @if ($errors->has('booking_conflict'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ $errors->first('booking_conflict') }}</span>
                        </div>
                    @endif
                    
                    <form action="{{ route('user.bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ruangan yang Dipinjam</label>
                            <p class="mt-1 p-2 bg-gray-100 rounded-md">{{ $room->room_code }} - {{ $room->name }} (Kapasitas: {{ $room->capacity }})</p>
                        </div>

                        <div class="mb-4">
                            <label for="purpose" class="block text-sm font-medium text-gray-700">Tujuan Peminjaman</label>
                            <input type="text" name="purpose" id="purpose" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('purpose') }}" required>
                            @error('purpose') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('start_time') }}" required>
                            @error('start_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                            <input type="datetime-local" name="end_time" id="end_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('end_time') }}" required>
                            @error('end_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>