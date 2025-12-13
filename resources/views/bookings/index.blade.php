<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Peminjaman Saya') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium transition">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6">
                    
                    @if($bookings->isEmpty())
                        {{-- Tampilan Jika Belum Ada Data --}}
                        <div class="text-center py-12">
                            <div class="bg-indigo-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Belum ada riwayat</h3>
                            <p class="text-gray-500 mt-1 mb-6">Anda belum pernah mengajukan peminjaman ruangan.</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                Ajukan Peminjaman Baru
                            </a>
                        </div>
                    @else
                        {{-- Tabel Data --}}
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Ruangan</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tujuan</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                        {{-- KOLOM BARU: AKSI --}}
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi (Undangan)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($bookings as $booking)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ $booking->room->name ?? 'Ruangan Dihapus' }}</div>
                                                <div class="text-xs text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded mt-1">
                                                    {{ $booking->room->room_code ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $booking->purpose }}">
                                                    {{ $booking->purpose }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($booking->status == 'approved')
                                                    <div class="flex flex-col space-y-2">
                                                        
                                                        {{-- TOMBOL 1: BROADCAST EMAIL (Otomatis Server) --}}
                                                        <form action="{{ route('user.bookings.broadcast', $booking) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded shadow transition">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                                Broadcast Email
                                                            </button>
                                                        </form>

                                                        {{-- TOMBOL 2: KIRIM WA (Manual Link) --}}
                                                        @php
                                                            // 1. Ambil Nama Peserta
                                                            $participantNames = $booking->participants ? $booking->participants->pluck('name')->toArray() : [];
                                                            
                                                            if (empty($participantNames)) {
                                                                $listPeserta = "-";
                                                            } else {
                                                                // Buat list menurun dengan bullet point strip
                                                                $listPeserta = "";
                                                                foreach($participantNames as $name) {
                                                                    $listPeserta .= "%0A- " . $name;
                                                                }
                                                            }

                                                            // 2. Format Waktu Indonesia
                                                            $waktuMulai = \Carbon\Carbon::parse($booking->start_time)->translatedFormat('l, d F Y');
                                                            $jamMulai   = \Carbon\Carbon::parse($booking->start_time)->format('H:i');
                                                            $jamSelesai = \Carbon\Carbon::parse($booking->end_time)->format('H:i');

                                                            // 3. Susun Pesan WA (Formal & Detail)
                                                            // %0A adalah kode untuk Enter (Baris Baru)
                                                            
                                                            $pesan  = "*UNDANGAN KEGIATAN KAMPUS*%0A%0A";
                                                            $pesan .= "Yth. Rekan Mahasiswa/Dosen,%0A";
                                                            $pesan .= "Kami mengundang Anda untuk menghadiri kegiatan berikut:%0A%0A";
                                                            
                                                            $pesan .= "*Nama Kegiatan:*%0A" . $booking->purpose . "%0A%0A";
                                                            $pesan .= "*Lokasi:*%0A" . ($booking->room->name ?? 'Ruangan') . "%0A%0A";
                                                            $pesan .= "*Waktu Pelaksanaan:*%0A";
                                                            $pesan .= "Hari/Tgl: " . $waktuMulai . "%0A";
                                                            $pesan .= "Pukul: " . $jamMulai . " - " . $jamSelesai . " WIB%0A%0A";
                                                            
                                                            $pesan .= "*Daftar Peserta Undangan:*";
                                                            $pesan .= $listPeserta . "%0A%0A";
                                                            
                                                            $pesan .= "Demikian undangan ini kami sampaikan. Mohon kehadirannya tepat waktu. Terima kasih.";
                                                            
                                                            // Generate Link
                                                            $wa_link = "https://wa.me/?text=" . $pesan;
                                                        @endphp

                                                        <a href="{{ $wa_link }}" target="_blank" class="w-full inline-flex justify-center items-center px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded shadow transition">
                                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                                            Share ke WA
                                                        </a>
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 text-xs italic">Menunggu persetujuan</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>