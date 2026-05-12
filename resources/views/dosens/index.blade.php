<x-layouts.app title="Daftar Dosen">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Data Dosen</h2>
            <p class="text-slate-600">Kelola Dosen Pembimbing Akademik di sistem.</p>
        </div>
        <a href="{{ route('dosens.create') }}" class="rounded bg-sky-600 px-4 py-2 text-white hover:bg-sky-700">Tambah Dosen</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-slate-700">
                <tr>
                    <th class="px-4 py-3 font-semibold">#</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">NIP</th>
                    <th class="px-4 py-3 font-semibold">Keahlian</th>
                    <th class="px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($dosens as $dosen)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $dosen->nama }}</td>
                        <td class="px-4 py-3">{{ $dosen->nip }}</td>
                        <td class="px-4 py-3">{{ $dosen->keahlian ?? '-' }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('dosens.edit', $dosen) }}" class="rounded bg-amber-500 px-3 py-1 text-white hover:bg-amber-600">Edit</a>
                            <form action="{{ route('dosens.destroy', $dosen) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data dosen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data dosen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
