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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam (NIM)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu & Tujuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->room->room_code ?? '-' }} - {{ $booking->room->name ?? 'Ruangan Dihapus' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name ?? 'User Dihapus' }} ({{ $booking->user->nim ?? 'N/A' }})</td>
                                        <td class="px-6 py-4">
                                            <p class="text-sm">Mulai: {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y H:i') }}</p>
                                            <p class="text-sm">Selesai: {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                                            <p class="text-xs text-indigo-600">Tujuan: {{ $booking->purpose }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($booking->status == 'approved') bg-green-100 text-green-800 
                                                @elseif($booking->status == 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($booking->status == 'pending')
                                                {{-- Tombol Approve --}}
                                                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Setujui</button>
                                                </form>
                                                
                                                {{-- Tombol Reject --}}
                                                <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada pengajuan peminjaman saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>