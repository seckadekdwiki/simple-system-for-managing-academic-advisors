<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{

    public function index()
    {
        $dosens = Dosen::orderBy('nama')->get();

        return view('dosens.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosens.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip',
            'keahlian' => 'nullable|string|max:255',
        ]);

        Dosen::create($validated);

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.form', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip,' . $dosen->id,
            'keahlian' => 'nullable|string|max:255',
        ]);

        $dosen->update($validated);

        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
