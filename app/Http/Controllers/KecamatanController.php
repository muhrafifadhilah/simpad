<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Kecamatan::query())->make(true);
        }
        return view('kecamatan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:4|unique:kecamatan,kode',
            'nama' => 'required|unique:kecamatan,nama',
            'tmt' => 'required|date',
            'status' => 'required|in:0,1',
        ]);
        Kecamatan::create($validated);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        return Kecamatan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $kec = Kecamatan::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|max:4|unique:kecamatan,kode,' . $id,
            'nama' => 'required|unique:kecamatan,nama,' . $id,
            'tmt' => 'required|date',
            'status' => 'required|in:0,1',
        ]);
        $kec->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $kec = Kecamatan::findOrFail($id);
        $kec->delete();
        return response()->json(['success' => true]);
    }
}
