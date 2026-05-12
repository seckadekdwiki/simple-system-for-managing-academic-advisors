<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DosenController extends Controller
{
    protected function flushCache(): void
    {
        Cache::forget('dosens.index');
        Cache::forget('mahasiswas.index');
    }

    public function index()
    {
        $dosens = Cache::remember('dosens.index', now()->addMinutes(30), function () {
            return Dosen::orderBy('nama')->get();
        });

        return view('dosens.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip',
            'keahlian' => 'nullable|string|max:255',
        ]);

        Dosen::create($validated);
        $this->flushCache();

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip,' . $dosen->id,
            'keahlian' => 'nullable|string|max:255',
        ]);

        $dosen->update($validated);
        $this->flushCache();

        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        $this->flushCache();

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
