<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Statistik (Ringkasan) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center justify-between hover:shadow-md transition duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Ruangan</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalRooms }} <span class="text-sm font-normal text-gray-400">unit</span></p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full text-blue-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500 flex items-center justify-between hover:shadow-md transition duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Butuh Approval</p>
                        <p class="text-3xl font-extrabold text-yellow-600 mt-1">{{ $pendingBookings }} <span class="text-sm font-normal text-gray-400">pengajuan</span></p>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-full text-yellow-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center justify-between hover:shadow-md transition duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Disetujui</p>
                        <p class="text-3xl font-extrabold text-green-600 mt-1">{{ $approvedBookings }} <span class="text-sm font-normal text-gray-400">reservasi</span></p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Bagian Grafik & Menu --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Kolom Kiri: Grafik Donat (Placeholder Chart.js) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 lg:col-span-1 border border-gray-100">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Status Peminjaman</h3>
                    <div class="relative h-64 flex items-center justify-center">
                        <canvas id="bookingChart"></canvas>
                    </div>
                </div>

                {{-- Kolom Kanan: Navigasi Cepat --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 lg:col-span-2 border border-gray-100">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Aksi Cepat</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.rooms.index') }}" class="flex items-center justify-between p-6 bg-gray-50 border border-gray-200 rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition duration-200 group cursor-pointer">
                            <div>
                                <h4 class="font-bold text-indigo-700 group-hover:text-indigo-900 text-lg">Kelola Ruangan</h4>
                                <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus data master ruangan.</p>
                            </div>
                            <div class="bg-white p-2 rounded-full shadow-sm group-hover:translate-x-1 transition-transform">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center justify-between p-6 bg-gray-50 border border-gray-200 rounded-xl hover:bg-yellow-50 hover:border-yellow-300 transition duration-200 group cursor-pointer">
                            <div>
                                <h4 class="font-bold text-indigo-700 group-hover:text-indigo-900 text-lg">Validasi Peminjaman</h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    @if($pendingBookings > 0)
                                        <span class="text-red-600 font-bold bg-red-100 px-2 py-0.5 rounded text-xs">Ada {{ $pendingBookings }} pengajuan baru!</span>
                                    @else
                                        Semua pengajuan telah diperiksa.
                                    @endif
                                </p>
                            </div>
                            <div class="bg-white p-2 rounded-full shadow-sm group-hover:translate-x-1 transition-transform">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bookingChart');

        // Data diambil dari variable PHP
        const pending = {{ $pendingBookings }};
        const approved = {{ $approvedBookings }};
        const rejected = {{ \App\Models\Booking::where('status', 'rejected')->count() }};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [pending, approved, rejected],
                    backgroundColor: [
                        '#FBBF24', // Kuning
                        '#10B981', // Hijau
                        '#EF4444'  // Merah
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>