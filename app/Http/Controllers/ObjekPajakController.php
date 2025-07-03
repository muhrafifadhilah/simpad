<?php

namespace App\Http\Controllers;

use App\Models\ObjekPajak;
use App\Models\SubjekPajak;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ObjekPajakController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ObjekPajak::query()
                ->leftJoin('subjek_pajak', 'objek_pajak.subjek_pajak_id', '=', 'subjek_pajak.id')
                ->select(
                    'objek_pajak.*',
                    'subjek_pajak.npwpd as subjek_npwpd'
                );
            if ($request->filled('subjek_pajak_id')) {
                $query->where('objek_pajak.subjek_pajak_id', $request->subjek_pajak_id);
            }
            if ($request->filled('kecamatan')) {
                $query->where('objek_pajak.kecamatan', $request->kecamatan);
            }
            return DataTables::of($query)
                ->editColumn('subjek_npwpd', function($row) {
                    return $row->subjek_npwpd;
                })
                ->make(true);
        }
        $subjekList = SubjekPajak::all();
        $kecamatanList = Kecamatan::all();
        return view('objek_pajak.index', compact('subjekList', 'kecamatanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subjek_pajak_id' => 'required|exists:subjek_pajak,id',
            'nopd' => 'required|unique:objek_pajak,nopd',
            'nama_usaha' => 'required',
            'kategori_usaha' => 'required',
            'jenis_usaha' => 'required',
            'jenis_pajak' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
            'keterangan' => 'nullable',
            'status' => 'required|in:aktif,tutup,tutup-sementara',
            'status_tmt' => 'required|date',
        ]);
        ObjekPajak::create($validated);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        return ObjekPajak::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $objek = ObjekPajak::findOrFail($id);
        $validated = $request->validate([
            'subjek_pajak_id' => 'required|exists:subjek_pajak,id',
            'nopd' => 'required|unique:objek_pajak,nopd,' . $id,
            'nama_usaha' => 'required',
            'kategori_usaha' => 'required',
            'jenis_usaha' => 'required',
            'jenis_pajak' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
            'keterangan' => 'nullable',
            'status' => 'required|in:aktif,tutup,tutup-sementara',
            'status_tmt' => 'required|date',
        ]);
        $objek->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $objek = ObjekPajak::findOrFail($id);
        $objek->delete();
        return response()->json(['success' => true]);
    }
}
