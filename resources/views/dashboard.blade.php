<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Ruangan Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Pilih Ruangan untuk Dipinjam</h3>

                    @if ($rooms->isEmpty())
                        <p class="text-gray-500">Maaf, belum ada data ruangan yang tersedia saat ini.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($rooms as $room)
                                <div class="border rounded-lg p-4 shadow-md flex flex-col justify-between">
                                    <div>
                                        <h4 class="text-xl font-semibold">{{ $room->name }} ({{ $room->room_code }})</h4>
                                        <p class="text-sm text-gray-600 mt-1">Kapasitas: {{ $room->capacity }} orang</p>
                                        <p class="text-gray-700 mt-2 text-sm">{{ Str::limit($room->description, 100) }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('user.bookings.create', $room->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700 w-full">
                                            Ajukan Peminjaman
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>