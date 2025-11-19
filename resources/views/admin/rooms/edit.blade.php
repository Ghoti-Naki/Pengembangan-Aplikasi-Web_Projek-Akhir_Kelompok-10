<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ruangan: ') . $room->room_code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- PENTING: Gunakan @method('PUT') untuk UPDATE --}}
                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="room_code" class="block text-sm font-medium text-gray-700">Kode Ruangan</label>
                            <input type="text" name="room_code" id="room_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('room_code', $room->room_code) }}" required>
                            @error('room_code')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name', $room->name) }}" required>
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas (orang)</label>
                            <input type="number" name="capacity" id="capacity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('capacity', $room->capacity) }}" required min="1">
                            @error('capacity')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $room->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Upload Gambar Baru (Kosongkan jika tidak diubah)</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                            @error('image')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                            @if($room->image)
                                <p class="text-sm text-gray-500 mt-2">Gambar saat ini: {{ $room->image }}</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.rooms.index') }}" class="text-gray-600 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Perbarui Ruangan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>