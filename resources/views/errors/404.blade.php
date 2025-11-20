<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <h1 class="text-9xl font-black text-gray-200">404</h1>
        <p class="text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Halaman Hilang?</p>
        <p class="mt-4 text-gray-500">Maaf, halaman yang Anda cari tidak dapat ditemukan di sistem SpaceFlow.</p>
        <a href="{{ url('/') }}" class="mt-6 inline-block px-5 py-3 bg-gray-800 text-white font-semibold rounded-full hover:bg-gray-900 transition">
            Balik ke Beranda
        </a>
    </div>
</body>
</html>