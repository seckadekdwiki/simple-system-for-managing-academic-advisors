<x-layouts.app title="{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}">
    <div class="max-w-3xl rounded-lg bg-white p-6 shadow-sm">
        <h2 class="text-2xl font-semibold mb-4">{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}</h2>

        @if($errors->any())
            <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($mahasiswa) ? route('mahasiswas.update', $mahasiswa) : route('mahasiswas.store') }}" method="POST" class="space-y-5">
            @csrf
            @if(isset($mahasiswa))
                @method('PUT')
            @endif

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Dosen Pembimbing Akademik</label>
                <select name="dosen_id" class="w-full rounded border border-slate-300 px-3 py-2 focus:border-sky-500 focus:outline-none">
                    <option value="">-- Pilih Dosen PA --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ old('dosen_id', $mahasiswa->dosen_id ?? '') == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->nama }} ({{ $dosen->nip }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="rounded bg-sky-600 px-5 py-2 text-white hover:bg-sky-700">Simpan</button>
                <a href="{{ route('mahasiswas.index') }}" class="text-slate-600 hover:text-slate-900">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.app>
