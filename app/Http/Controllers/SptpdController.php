<?php

namespace App\Http\Controllers;

use App\Models\Sptpd;
use App\Models\ObjekPajak;
use App\Models\SubjekPajak;
use App\Models\Upt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class SptpdController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = \App\Models\Sptpd::with(['objekPajak.subjekPajak']);
            
            // Apply search filters
            if ($request->filled('search_nopd')) {
                $query->whereHas('objekPajak', function($q) use ($request) {
                    $q->where('nopd', 'like', '%' . $request->search_nopd . '%');
                });
            }
            
            if ($request->filled('search_nama')) {
                $query->whereHas('objekPajak.subjekPajak', function($q) use ($request) {
                    $q->where('subjek_pajak', 'like', '%' . $request->search_nama . '%');
                });
            }
            
            if ($request->filled('search_jenis')) {
                $query->whereHas('objekPajak', function($q) use ($request) {
                    $q->where('jenis_pajak', 'like', '%' . $request->search_jenis . '%');
                });
            }
            
            if ($request->filled('search_periode')) {
                $periode = \Carbon\Carbon::parse($request->search_periode);
                $query->whereYear('masa_pajak_awal', $periode->year)
                      ->whereMonth('masa_pajak_awal', $periode->month);
            }
            
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
                ->addColumn('total_pajak', function($row) {
                    return number_format($row->total_pajak_terutang ?? 0, 0, ',', '.');
                })
                ->addColumn('status', function($row) {
                    $statusClass = $row->status === 'Draft' ? 'warning' : 'success';
                    return '<span class="badge bg-' . $statusClass . '">' . $row->status . '</span>';
                })
                ->addColumn('keterangan', function($row) {
                    return $row->keterangan ? substr($row->keterangan, 0, 50) . '...' : '-';
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
            'tanggal_terima' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'masa_pajak_awal' => 'required|date',
            'masa_pajak_akhir' => 'required|date',
            'total_pajak_terutang' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            $objek = \App\Models\ObjekPajak::with('subjekPajak')->findOrFail($request->objek_pajak_id);
            
            $sptpd = new \App\Models\Sptpd();
            $sptpd->objek_pajak_id = $request->objek_pajak_id;
            $sptpd->subjek_pajak_id = $objek->subjek_pajak_id;
            $sptpd->upt_id = $request->upt_id;
            $sptpd->tanggal_terima = $request->tanggal_terima;
            $sptpd->jatuh_tempo = $request->jatuh_tempo;
            $sptpd->masa_pajak_awal = $request->masa_pajak_awal;
            $sptpd->masa_pajak_akhir = $request->masa_pajak_akhir;
            $sptpd->total_pajak_terutang = $request->total_pajak_terutang;
            $sptpd->keterangan = $request->keterangan;
            $sptpd->status = 'Draft';
            $sptpd->save();

            // Check if AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'SPTPD berhasil ditambahkan',
                    'data' => $sptpd
                ]);
            }

            return redirect()->route('sptpd.index')->with('success', 'SPTPD berhasil ditambahkan');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan data: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
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
            'tanggal_terima' => 'required|date',
            'masa_pajak_awal' => 'required|date',
            'masa_pajak_akhir' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'total_pajak_terutang' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            $objek = \App\Models\ObjekPajak::with('subjekPajak')->findOrFail($request->objek_pajak_id);
            
            $sptpd->objek_pajak_id = $request->objek_pajak_id;
            $sptpd->subjek_pajak_id = $objek->subjek_pajak_id;
            $sptpd->upt_id = $request->upt_id;
            $sptpd->tanggal_terima = $request->tanggal_terima;
            $sptpd->masa_pajak_awal = $request->masa_pajak_awal;
            $sptpd->masa_pajak_akhir = $request->masa_pajak_akhir;
            $sptpd->jatuh_tempo = $request->jatuh_tempo;
            $sptpd->total_pajak_terutang = $request->total_pajak_terutang;
            $sptpd->keterangan = $request->keterangan;
            $sptpd->save();

            // Check if AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'SPTPD berhasil diupdate',
                    'data' => $sptpd
                ]);
            }

            return redirect()->route('sptpd.index')->with('success', 'SPTPD berhasil diupdate');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupdate data: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Gagal mengupdate data: ' . $e->getMessage()]);
        }
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

    public function exportPdf(Request $request)
    {
        try {
            // Increase memory limit for PDF generation
            ini_set('memory_limit', '1024M');
            set_time_limit(300); // 5 minutes
            
            // Get SPTPD data with relationships
            $query = \App\Models\Sptpd::with(['objekPajak.subjekPajak']);
            
            // Apply search filters if provided
            if ($request->filled('search_nopd')) {
                $query->whereHas('objekPajak', function($q) use ($request) {
                    $q->where('nopd', 'like', '%' . $request->search_nopd . '%');
                });
            }
            
            if ($request->filled('search_nama')) {
                $query->whereHas('objekPajak.subjekPajak', function($q) use ($request) {
                    $q->where('subjek_pajak', 'like', '%' . $request->search_nama . '%');
                });
            }
            
            if ($request->filled('search_jenis')) {
                $query->whereHas('objekPajak', function($q) use ($request) {
                    $q->where('jenis_pajak', 'like', '%' . $request->search_jenis . '%');
                });
            }
            
            if ($request->filled('search_periode')) {
                $periode = \Carbon\Carbon::parse($request->search_periode);
                $query->whereYear('masa_pajak_awal', $periode->year)
                      ->whereMonth('masa_pajak_awal', $periode->month);
            }
            
            // Limit data to prevent memory issues
            $sptpds = $query->orderBy('created_at', 'desc')->limit(1000)->get();
            
            // Generate PDF with DomPDF options
            $pdf = Pdf::loadView('sptpd.pdf', compact('sptpds'))
                ->setOptions([
                    'dpi' => 96,
                    'defaultFont' => 'Arial',
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true
                ]);
            
            // Set paper size and orientation
            $pdf->setPaper('A4', 'landscape');
            
            // Generate filename with timestamp
            $filename = 'data_sptpd_' . date('Y-m-d_H-i-s') . '.pdf';
            
            // Return PDF download
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('PDF Export Error: ' . $e->getMessage());
            
            // Return error response
            return response()->json([
                'error' => true,
                'message' => 'Gagal mengexport PDF: ' . $e->getMessage()
            ], 500);
        }
    }
}
