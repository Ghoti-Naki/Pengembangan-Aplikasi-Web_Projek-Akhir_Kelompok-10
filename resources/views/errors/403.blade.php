<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <h1 class="text-9xl font-black text-indigo-200">403</h1>
        <p class="text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Akses Ditolak!</p>
        <p class="mt-4 text-gray-500">Waduh, Anda tidak memiliki izin untuk masuk ke area ini.<br>Area ini khusus untuk petugas berwenang.</p>
        <a href="{{ url('/dashboard') }}" class="mt-6 inline-block px-5 py-3 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition">
            Kembali ke Dashboard Aman
        </a>
    </div>
</body>
</html>