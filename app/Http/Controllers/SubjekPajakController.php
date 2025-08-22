<?php

namespace App\Http\Controllers;

use App\Models\SubjekPajak;
use App\Models\User;
use App\Models\Wp;
use App\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan barryvdh/laravel-dompdf sudah diinstall
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kecamatan;

class SubjekPajakController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SubjekPajak::query();
            
            // Filter berdasarkan subjek pajak
            if ($request->filled('subjek')) {
                $query->where('subjek_pajak', 'like', '%' . $request->subjek . '%');
            }
            
            // Filter berdasarkan pemilik
            if ($request->filled('pemilik')) {
                $query->where('pemilik', 'like', '%' . $request->pemilik . '%');
            }
            
            return DataTables::of($query)
                ->addColumn('npwpd', function($row) {
                    return $row->npwpd;
                })
                ->addColumn('subjek_pajak', function($row) {
                    return $row->subjek_pajak;
                })
                ->addColumn('pemilik', function($row) {
                    return $row->pemilik;
                })
                ->addColumn('alamat', function($row) {
                    return $row->alamat;
                })
                ->addColumn('kecamatan', function($row) {
                    return $row->kecamatan;
                })
                ->addColumn('kelurahan', function($row) {
                    return $row->kelurahan;
                })
                ->rawColumns(['npwpd', 'subjek_pajak', 'pemilik', 'alamat', 'kecamatan', 'kelurahan'])
                ->make(true);
        }
        return view('subjek_pajak.index');
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

        // Buat subjek pajak
        $subjekPajak = SubjekPajak::create($validated);

        // Otomatis buat akun WP
        $this->createWpAccount($subjekPajak, $validated);

        return response()->json([
            'success' => true, 
            'no_form' => $no_form, 
            'npwpd' => $npwpd,
            'message' => 'Subjek Pajak berhasil dibuat. Akun WP telah dibuat otomatis dengan username: ' . $npwpd
        ]);
    }

    /**
     * Membuat akun WP otomatis ketika subjek pajak dibuat
     */
    private function createWpAccount(SubjekPajak $subjekPajak, array $validatedData)
    {
        // Cari role wp
        $wpRole = Role::where('name', 'wp')->first();
        if (!$wpRole) {
            // Jika role wp belum ada, buat dulu
            $wpRole = Role::create(['name' => 'wp']);
        }

        // Generate username dari NPWPD
        $username = $subjekPajak->npwpd;
        
        // Generate password default (bisa diubah nanti)
        $defaultPassword = 'wp' . date('Y'); // contoh: wp2025
        
        // Buat user account
        $user = User::create([
            'userid' => $username,
            'role_id' => $wpRole->id,
            'password' => Hash::make($defaultPassword),
        ]);

        // Generate NIP unik untuk WP
        $nip = 'WP-' . date('Ymd') . '-' . str_pad($subjekPajak->id, 4, '0', STR_PAD_LEFT);
        while (Wp::where('nip', $nip)->exists()) {
            $nip = 'WP-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        }

        // Buat record WP
        Wp::create([
            'user_id' => $user->id,
            'subjek_pajak_id' => $subjekPajak->id,
            'name' => $validatedData['pemilik'], // atau subjek_pajak
            'nip' => $nip,
            'nohp' => $validatedData['nohp'],
            'disabled' => false,
        ]);

        return [
            'username' => $username,
            'password' => $defaultPassword,
            'nip' => $nip
        ];
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
        
        // Hapus akun WP terkait jika ada
        $wp = Wp::where('subjek_pajak_id', $subjek->id)->first();
        if ($wp) {
            // Hapus user account terkait
            $wp->user()->delete();
            // WP record akan terhapus otomatis karena foreign key cascade
        }
        
        $subjek->delete();
        return response()->json(['success' => true]);
    }

    public function cetakKartu($id)
    {
        $subjek = \App\Models\SubjekPajak::findOrFail($id);

        // Menggunakan ukuran A4 portrait untuk kartu berdampingan
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('subjek_pajak.kartu_pdf', compact('subjek'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'defaultFont' => 'Arial',
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'dpi' => 96
            ]);

        return $pdf->stream('kartu-npwpd-'.$subjek->npwpd.'.pdf');
    }

    /**
     * Mendapatkan informasi akun WP dari subjek pajak
     */
    public function getWpAccount($id)
    {
        $subjek = SubjekPajak::findOrFail($id);
        $wp = Wp::where('subjek_pajak_id', $subjek->id)->with('user')->first();
        
        if (!$wp) {
            return response()->json([
                'success' => false,
                'message' => 'Akun WP tidak ditemukan untuk subjek pajak ini.'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'username' => $wp->user->userid,
                'name' => $wp->name,
                'nip' => $wp->nip,
                'nohp' => $wp->nohp,
                'npwpd' => $subjek->npwpd,
                'disabled' => $wp->disabled,
                'created_at' => $wp->created_at->format('d/m/Y H:i')
            ]
        ]);
    }

    /**
     * Reset password akun WP
     */
    public function resetWpPassword($id)
    {
        $subjek = SubjekPajak::findOrFail($id);
        $wp = Wp::where('subjek_pajak_id', $subjek->id)->with('user')->first();
        
        if (!$wp) {
            return response()->json([
                'success' => false,
                'message' => 'Akun WP tidak ditemukan.'
            ]);
        }
        
        $newPassword = 'wp' . date('Y');
        $wp->user->update(['password' => Hash::make($newPassword)]);
        
        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset.',
            'new_password' => $newPassword
        ]);
    }
}

