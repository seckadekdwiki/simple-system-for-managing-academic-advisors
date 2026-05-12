<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem KRS - PA' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold">Sistem KRS Sederhana</h1>
            <p class="text-slate-600">Mapping Dosen Pembimbing Akademik (PA) untuk Mahasiswa.</p>
            <nav class="mt-4 flex gap-3 text-sm">
                <a href="{{ route('mahasiswas.index') }}" class="px-3 py-2 bg-slate-900 text-white rounded">Mahasiswa</a>
                <a href="{{ route('dosens.index') }}" class="px-3 py-2 bg-slate-200 hover:bg-slate-300 rounded">Dosen</a>
            </nav>
        </header>

        @if(session('success'))
            <div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </div>
</body>
</html>
