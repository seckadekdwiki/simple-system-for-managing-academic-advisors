<x-layouts.app title="{{ isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen' }}">
    <div class="max-w-3xl rounded-lg bg-white p-6 shadow-sm">
        <h2 class="text-2xl font-semibold mb-4">{{ isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen' }}</h2>

        @if($errors->any())
            <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($dosen) ? route('dosens.update', $dosen) : route('dosens.store') }}" method="POST" class="space-y-5">
            @csrf
            @if(isset($dosen))
                @method('PUT')
            @endif

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nama Dosen</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $dosen->nip ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Keahlian</label>
                <input type="text" name="keahlian" value="{{ old('keahlian', $dosen->keahlian ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none">
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="rounded bg-sky-600 px-5 py-2 text-white hover:bg-sky-700">Simpan</button>
                <a href="{{ route('dosens.index') }}" class="text-slate-600 hover:text-slate-900">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.app>
