<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validasi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-xl font-bold mb-4">Daftar Semua Pengajuan</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Ruangan & Waktu</th>
                                    {{-- KOLOM BARU --}}
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Daftar Peserta</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status & Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->user->nim ?? 'Dosen' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium">{{ $booking->room->name }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}
                                        </div>
                                    </td>
                                    
                                    {{-- LOGIC MENAMPILKAN PESERTA --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <details class="cursor-pointer group">
                                            <summary class="font-medium text-indigo-600 hover:text-indigo-800 focus:outline-none">
                                                Lihat Peserta ({{ $booking->participants->count() + $booking->guests->count() }})
                                            </summary>
                                            <div class="mt-2 p-3 bg-gray-50 rounded text-xs space-y-2 border border-gray-100">
                                                
                                                {{-- 1. PESERTA INTERNAL --}}
                                                @if($booking->participants->isNotEmpty())
                                                    <div>
                                                        <strong class="text-gray-700 block mb-1">Mahasiswa/Dosen:</strong>
                                                        <ul class="list-disc pl-4 space-y-0.5">
                                                            @foreach($booking->participants as $p)
                                                                <li>{{ $p->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                {{-- 2. TAMU EKSTERNAL --}}
                                                @if($booking->guests->isNotEmpty())
                                                    <div class="{{ $booking->participants->isNotEmpty() ? 'mt-2 border-t pt-2' : '' }}">
                                                        <strong class="text-gray-700 block mb-1">Tamu Eksternal:</strong>
                                                        <ul class="list-disc pl-4 space-y-0.5">
                                                            @foreach($booking->guests as $g)
                                                                <li>
                                                                    <span class="font-semibold">{{ $g->email }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                @if($booking->participants->isEmpty() && $booking->guests->isEmpty())
                                                    <span class="text-gray-400 italic">Tidak ada peserta tambahan.</span>
                                                @endif
                                            </div>
                                        </details>
                                    </td>

                                    <td class="px-6 py-4">
                                    {{-- Tombol Aksi (Approve/Reject) Anda yang sudah ada --}}
                                        @if($booking->status == 'pending')
                                            <div class="flex space-x-2">
                                                {{-- TOMBOL SETUJUI --}}
                                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-md text-xs font-bold transition flex items-center" title="Setujui">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                        Terima
                                                    </button>
                                                </form>

                                                {{-- TOMBOL TOLAK --}}
                                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-xs font-bold transition flex items-center" title="Tolak">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="px-2 py-1 rounded {{ $booking->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-bold">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>