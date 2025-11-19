<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Statistik (Ringkasan) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium">Total Ruangan</div>
                    <div class="mt-2 flex items-center">
                        <div class="text-3xl font-bold text-gray-900">{{ $totalRooms }}</div>
                        <span class="ml-2 text-sm text-gray-400">unit</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm font-medium">Menunggu Persetujuan</div>
                    <div class="mt-2 flex items-center">
                        <div class="text-3xl font-bold text-yellow-600">{{ $pendingBookings }}</div>
                        <span class="ml-2 text-sm text-gray-400">pengajuan</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium">Total Disetujui</div>
                    <div class="mt-2 flex items-center">
                        <div class="text-3xl font-bold text-green-600">{{ $approvedBookings }}</div>
                        <span class="ml-2 text-sm text-gray-400">reservasi</span>
                    </div>
                </div>
            </div>

            {{-- Bagian Menu Navigasi Cepat --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Aksi Cepat</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.rooms.index') }}" class="flex items-center justify-between p-6 bg-gray-50 border rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition duration-200 group">
                            <div>
                                <h4 class="font-bold text-indigo-700 group-hover:text-indigo-900">Kelola Ruangan</h4>
                                <p class="text-sm text-gray-600">Tambah, edit, atau hapus data master ruangan.</p>
                            </div>
                            <span class="text-2xl text-indigo-400 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        
                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center justify-between p-6 bg-gray-50 border rounded-lg hover:bg-yellow-50 hover:border-yellow-300 transition duration-200 group">
                            <div>
                                <h4 class="font-bold text-indigo-700 group-hover:text-indigo-900">Validasi Peminjaman</h4>
                                <p class="text-sm text-gray-600">
                                    @if($pendingBookings > 0)
                                        <span class="text-red-600 font-bold">Ada {{ $pendingBookings }} pengajuan baru!</span>
                                    @else
                                        Cek status persetujuan peminjaman.
                                    @endif
                                </p>
                            </div>
                            <span class="text-2xl text-indigo-400 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>