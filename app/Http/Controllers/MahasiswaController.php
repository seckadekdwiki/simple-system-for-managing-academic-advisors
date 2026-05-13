<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswas = Mahasiswa::with('dosen')->orderBy('nama')->get();

        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosens = Dosen::orderBy('nama')->get();

        return view('mahasiswas.form', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswas,nim',
            'jurusan' => 'required|string|max:255',
            'dosen_id' => 'nullable|exists:dosens,id',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::orderBy('nama')->get();

        return view('mahasiswas.form', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $mahasiswa->id,
            'jurusan' => 'required|string|max:255',
            'dosen_id' => 'nullable|exists:dosens,id',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswas.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
