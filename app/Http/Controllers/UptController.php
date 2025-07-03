<?php

namespace App\Http\Controllers;

use App\Models\Upt;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UptController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Upt::query())->make(true);
        }
        return view('upt.index');
    }

    public function create()
    {
        $kecamatanList = Kecamatan::where('status', 1)->get();
        return view('upt.form', compact('kecamatanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no' => 'required|unique:upt,no',
            'nama' => 'required',
            'kepala_upt' => 'required',
            'alamat' => 'required',
            'status' => 'nullable|boolean',
            'kecamatan_ids' => 'array'
        ]);
        $validated['status'] = $request->has('status') ? 1 : 0;

        DB::beginTransaction();
        $upt = Upt::create($validated);
        if ($request->has('kecamatan_ids')) {
            $upt->kecamatans()->sync($request->kecamatan_ids);
        }
        DB::commit();
        return redirect()->route('upt.index')->with('success', 'UPT berhasil disimpan');
    }

    public function edit($id)
    {
        $upt = Upt::with('kecamatans')->findOrFail($id);
        $kecamatanList = Kecamatan::where('status', 1)->get();
        return view('upt.form', compact('upt', 'kecamatanList'));
    }

    public function update(Request $request, $id)
    {
        $upt = Upt::findOrFail($id);
        $validated = $request->validate([
            'no' => 'required|unique:upt,no,' . $id,
            'nama' => 'required',
            'kepala_upt' => 'required',
            'alamat' => 'required',
            'status' => 'nullable|boolean',
            'kecamatan_ids' => 'array'
        ]);
        $validated['status'] = $request->has('status') ? 1 : 0;

        DB::beginTransaction();
        $upt->update($validated);
        $upt->kecamatans()->sync($request->kecamatan_ids ?? []);
        DB::commit();
        return redirect()->route('upt.index')->with('success', 'UPT berhasil diupdate');
    }

    public function destroy($id)
    {
        $upt = Upt::findOrFail($id);
        $upt->kecamatans()->detach();
        $upt->delete();
        return response()->json(['success' => true]);
    }
}
