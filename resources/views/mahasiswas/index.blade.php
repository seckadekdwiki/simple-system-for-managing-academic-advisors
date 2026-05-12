<x-layouts.app title="Daftar Mahasiswa">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Data Mahasiswa</h2>
            <p class="text-slate-600">Daftar mahasiswa dan Dosen PA yang membimbing.</p>
        </div>
        <a href="{{ route('mahasiswas.create') }}" class="rounded bg-sky-600 px-4 py-2 text-white hover:bg-sky-700">Tambah Mahasiswa</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-slate-700">
                <tr>
                    <th class="px-4 py-3 font-semibold">#</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">NIM</th>
                    <th class="px-4 py-3 font-semibold">Jurusan</th>
                    <th class="px-4 py-3 font-semibold">Dosen PA</th>
                    <th class="px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($mahasiswas as $mahasiswa)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->nama }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->nim }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->jurusan }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->dosen?->nama ?? '-' }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('mahasiswas.edit', $mahasiswa) }}" class="rounded bg-amber-500 px-3 py-1 text-white hover:bg-amber-600">Edit</a>
                            <form action="{{ route('mahasiswas.destroy', $mahasiswa) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data mahasiswa ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
