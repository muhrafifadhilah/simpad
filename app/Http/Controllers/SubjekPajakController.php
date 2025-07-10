<?php

namespace App\Http\Controllers;

use App\Models\SubjekPajak;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan barryvdh/laravel-dompdf sudah diinstall
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kecamatan;

class SubjekPajakController extends Controller
{
    public function index(Request $request)
    {
        $kecamatans = Kecamatan::all();
        if ($request->ajax()) {
            $query = SubjekPajak::query();
            if ($request->filled('tipe')) {
                $query->where('pribadi_badan', $request->tipe);
            }
            return DataTables::of($query)->make(true);
        }
        return view('subjek_pajak.index', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pribadi_badan' => 'required|in:pribadi,badan',
            'pemilik' => 'required',
            'subjek_pajak' => 'required',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kabupaten' => 'required',
            'kode_pos' => 'required',
            'nohp' => 'required',
            'email' => 'required|email',
            'noPengukuhan' => 'required',
            'tanggalPengukuhan' => 'required|date',
            'pejabat' => 'required',
        ]);

        // Generate no_form unik (misal: SUBJ-YYYYMMDD-XXXX)
        $no_form = 'SUBJ-' . date('Ymd', strtotime($validated['tanggal'])) . '-' . strtoupper(Str::random(4));
        while (SubjekPajak::where('no_form', $no_form)->exists()) {
            $no_form = 'SUBJ-' . date('Ymd', strtotime($validated['tanggal'])) . '-' . strtoupper(Str::random(4));
        }

        // Generate npwpd: TAHUNBULAN-TANGGAL-KODEUNIK (misal: 202406-01-XXXX)
        $date = date('Ymd', strtotime($validated['tanggal']));
        $kodeUnik = strtoupper(Str::random(4));
        $npwpd = $date . '-' . $kodeUnik;
        while (SubjekPajak::where('npwpd', $npwpd)->exists()) {
            $kodeUnik = strtoupper(Str::random(4));
            $npwpd = $date . '-' . $kodeUnik;
        }

        $validated['no_form'] = $no_form;
        $validated['npwpd'] = $npwpd;

        SubjekPajak::create($validated);
        return response()->json(['success' => true, 'no_form' => $no_form, 'npwpd' => $npwpd]);
    }

    public function show($id)
    {
        return SubjekPajak::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $subjek = SubjekPajak::findOrFail($id);
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pribadi_badan' => 'required|in:pribadi,badan',
            'pemilik' => 'required',
            'subjek_pajak' => 'required',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kabupaten' => 'required',
            'kode_pos' => 'required',
            'nohp' => 'required',
            'email' => 'required|email',
            'noPengukuhan' => 'required',
            'tanggalPengukuhan' => 'required|date',
            'pejabat' => 'required',
        ]);
        // no_form dan npwpd tidak diubah saat update
        $subjek->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $subjek = SubjekPajak::findOrFail($id);
        $subjek->delete();
        return response()->json(['success' => true]);
    }

    public function cetakKartu($id)
    {
        $subjek = \App\Models\SubjekPajak::findOrFail($id);

        // Ukuran kartu ID Card: 85.6mm x 53.98mm = 242 x 153 point (1 mm = 2.83465 point)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('subjek_pajak.kartu_pdf', compact('subjek'))
            ->setPaper([0, 0, 242, 153], 'landscape');

        return $pdf->stream('kartu-npwpd-'.$subjek->npwpd.'.pdf');
    }
}

