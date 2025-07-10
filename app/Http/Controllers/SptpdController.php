<?php

namespace App\Http\Controllers;

use App\Models\Sptpd;
use App\Models\ObjekPajak;
use App\Models\SubjekPajak;
use App\Models\Upt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SptpdController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = \App\Models\Sptpd::with(['objekPajak.subjekPajak']);
            return DataTables::of($query)
                ->addColumn('no_sptpd', function($row) {
                    // Format: YYYY.MM.DD.00001x
                    $date = $row->created_at ?? now();
                    $idFormatted = str_pad($row->id, 5, '0', STR_PAD_LEFT);
                    return $date->format('Y.m.d') . '.' . $idFormatted;
                })
                ->addColumn('tanggal', function($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y') : '';
                })
                ->addColumn('dok', function($row) {
                    return 'SKPD';
                })
                ->addColumn('nopd', function($row) {
                    return $row->objekPajak->nopd ?? '-';
                })
                ->addColumn('subjek_pajak', function($row) {
                    // Hanya nama subjek pajak saja
                    return $row->objekPajak->subjekPajak->subjek_pajak ?? '-';
                })
                ->addColumn('kecamatan', function($row) {
                    return $row->objekPajak->kecamatan ?? '-';
                })
                ->addColumn('kelurahan', function($row) {
                    return $row->objekPajak->kelurahan ?? '-';
                })
                ->addColumn('jenis_pajak', function($row) {
                    return $row->objekPajak->jenis_pajak ?? '-';
                })
                ->addColumn('masa', function($row) {
                    return $row->masa_pajak_awal ? \Carbon\Carbon::parse($row->masa_pajak_awal)->format('M Y') : '';
                })
                ->addColumn('dasar', function($row) {
                    return $row->dasar ?? 0;
                })
                ->addColumn('omset_tapping_box', function($row) {
                    return $row->omset_tapping_box ?? 0;
                })
                ->addColumn('pajak', function($row) {
                    return $row->pajak_terutang ?? 0;
                })
                ->rawColumns(['subjek_pajak'])
                ->make(true);
        }
        return view('sptpd.index');
    }

    public function create()
    {
        $objekPajaks = \App\Models\ObjekPajak::with('subjekPajak')->get();
        $upts = Upt::all();
        return view('sptpd.create', compact('objekPajaks', 'upts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'objek_pajak_id' => 'required|exists:objek_pajak,id',
            'upt_id' => 'required|exists:upt,id',
            'masa_pajak_awal' => 'required|date',
            'masa_pajak_akhir' => 'required|date',
            'jatuh_tempo' => 'required|date',
            // ...tambahkan validasi lain sesuai kebutuhan...
        ]);
        $objek = \App\Models\ObjekPajak::with('subjekPajak')->findOrFail($request->objek_pajak_id);
        $sptpd = new \App\Models\Sptpd($request->all());
        $sptpd->subjek_pajak_id = $objek->subjek_pajak_id;
        $sptpd->save();
        return redirect()->route('sptpd.index')->with('success', 'SPTPD berhasil ditambahkan');
    }

    public function show(Sptpd $sptpd)
    {
        $sptpd->load('objekPajak.subjekPajak');
        return view('sptpd.show', compact('sptpd'));
    }

    public function edit(Sptpd $sptpd)
    {
        $objekPajaks = \App\Models\ObjekPajak::with('subjekPajak')->get();
        $upts = Upt::all();
        $sptpd->load('objekPajak.subjekPajak');
        return view('sptpd.edit', compact('sptpd', 'objekPajaks', 'upts'));
    }

    public function update(Request $request, Sptpd $sptpd)
    {
        $request->validate([
            'objek_pajak_id' => 'required|exists:objek_pajak,id',
            'upt_id' => 'required|exists:upt,id',
            'masa_pajak_awal' => 'required|date',
            'masa_pajak_akhir' => 'required|date',
            'jatuh_tempo' => 'required|date',
            // ...tambahkan validasi lain sesuai kebutuhan...
        ]);
        $objek = \App\Models\ObjekPajak::with('subjekPajak')->findOrFail($request->objek_pajak_id);
        $sptpd->fill($request->all());
        $sptpd->subjek_pajak_id = $objek->subjek_pajak_id;
        $sptpd->save();
        return redirect()->route('sptpd.index')->with('success', 'SPTPD berhasil diupdate');
    }

    public function destroy(Sptpd $sptpd)
    {
        // Cek jika request AJAX (DataTables) atau bukan
        if (request()->ajax()) {
            try {
                $sptpd->delete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
            }
        }
        // Jika bukan AJAX (misal form biasa)
        $sptpd->delete();
        return redirect()->route('sptpd.index')->with('success', 'SPTPD berhasil dihapus');
    }
}
