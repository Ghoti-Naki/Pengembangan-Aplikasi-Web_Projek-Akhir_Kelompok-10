<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Header & Tombol Tambah --}}
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold">Daftar Ruangan</h3>
                        <a href="{{ route('admin.rooms.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md transition">
                            + Tambah Ruangan
                        </a>
                    </div>
                    
                    {{-- Notifikasi Success (Opsional jika sudah pakai Toast) --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Tabel Data --}}
                    <div class="overflow-x-auto">
                        <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Kode</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Nama Ruangan</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Kapasitas</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Deskripsi Singkat</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($rooms as $room)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    {{ $room->room_code }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $room->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $room->capacity }} Orang</td>
                                            <td class="px-6 py-4 text-gray-500 text-sm max-w-xs truncate">{{ Str::limit($room->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.rooms.edit', $room) }}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">Edit</a>
                                                
                                                {{-- Tombol Hapus dengan SweetAlert --}}
                                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="text-red-600 hover:text-red-900 font-bold btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                                Tidak ada data ruangan. Klik tombol tambah untuk memulai.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua tombol dengan class .btn-delete
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    // Cari form terdekat dari tombol yang diklik
                    const form = this.closest('.delete-form');

                    // Tampilkan SweetAlert
                    Swal.fire({
                        title: 'Yakin hapus ruangan ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika user klik "Ya", submit form
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>