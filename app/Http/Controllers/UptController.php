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
            $query = Upt::query();
            return DataTables::of($query)
                ->addColumn('no', function($row) {
                    return '';
                })
                ->addColumn('nama_upt', function($row) {
                    return $row->nama;
                })
                ->make(true);
        }
        return view('upt.index');
    }

    public function create()
    {
        $kecamatanList = Kecamatan::where('status', 1)->get();
        return view('upt.form', compact('kecamatanList'));
    }

    public function show($id)
    {
        $upt = Upt::with('kecamatans')->findOrFail($id);
        // Map nama ke nama_upt untuk frontend
        $upt->nama_upt = $upt->nama;
        return response()->json($upt);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_upt' => 'required',
            'kepala_upt' => 'required',
            'alamat' => 'required',
            'kecamatan_ids' => 'array'
        ]);
        
        // Map nama_upt ke nama untuk database
        $data = [
            'no' => str_pad(Upt::count() + 1, 3, '0', STR_PAD_LEFT),
            'nama' => $validated['nama_upt'],
            'kepala_upt' => $validated['kepala_upt'],
            'alamat' => $validated['alamat'],
            'status' => 1
        ];

        DB::beginTransaction();
        try {
            $upt = Upt::create($data);
            if ($request->has('kecamatan_ids')) {
                $upt->kecamatans()->sync($request->kecamatan_ids);
            }
            DB::commit();
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'UPT berhasil disimpan']);
            }
            return redirect()->route('upt.index')->with('success', 'UPT berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Gagal menyimpan UPT: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Gagal menyimpan UPT: ' . $e->getMessage()]);
        }
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
            'nama_upt' => 'required',
            'kepala_upt' => 'required',
            'alamat' => 'required',
            'kecamatan_ids' => 'array'
        ]);

        // Map nama_upt ke nama untuk database
        $data = [
            'nama' => $validated['nama_upt'],
            'kepala_upt' => $validated['kepala_upt'],
            'alamat' => $validated['alamat']
        ];

        DB::beginTransaction();
        try {
            $upt->update($data);
            $upt->kecamatans()->sync($request->kecamatan_ids ?? []);
            DB::commit();
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'UPT berhasil diupdate']);
            }
            return redirect()->route('upt.index')->with('success', 'UPT berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Gagal mengupdate UPT: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Gagal mengupdate UPT: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $upt = Upt::findOrFail($id);
            $upt->kecamatans()->detach();
            $upt->delete();
            
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'UPT berhasil dihapus']);
            }
            return redirect()->route('upt.index')->with('success', 'UPT berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus UPT: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Gagal menghapus UPT: ' . $e->getMessage()]);
        }
    }

    public function getKecamatan($id)
    {
        $upt = \App\Models\Upt::with('kecamatans')->findOrFail($id);
        return response()->json($upt->kecamatans->map(function($kec) {
            return [
                'id' => $kec->id,
                'nama' => $kec->nama
            ];
        }));
    }
}
