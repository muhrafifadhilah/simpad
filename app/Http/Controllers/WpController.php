<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wp;
use App\Models\SubjekPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class WpController extends Controller
{
    public function index(Request $request)
    {
        $wajibPajak = Wp::with(['user', 'subjekPajak'])->get();
        return view('wp.index', compact('wajibPajak'));
    }

    public function create()
    {
        return view('wp.create');
    }

    public function cariSubjek(Request $request)
    {
        $keyword = $request->input('keyword');
        $subjek = SubjekPajak::where('subjek_pajak', 'like', "%$keyword%")
            ->orWhere('npwpd', 'like', "%$keyword%")
            ->first();

        if ($subjek) {
            return response()->json([
                'success' => true,
                'data' => [
                    'npwpd' => $subjek->npwpd,
                    'nama' => $subjek->subjek_pajak,
                    'nohp' => $subjek->nohp,
                    'id' => $subjek->id,
                ]
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Subjek Pajak tidak ditemukan']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek_pajak_id' => 'required|exists:subjek_pajak,id',
            'password' => 'required|min:6',
        ]);

        DB::beginTransaction();
        try {
            $subjek = SubjekPajak::findOrFail($request->subjek_pajak_id);

            // Buat user
            $user = User::create([
                'userid' => $subjek->npwpd,
                'name' => $subjek->subjek_pajak,
                'role_id' => 2,
                'password' => Hash::make($request->password),
            ]);

            // Buat wp
            Wp::create([
                'user_id' => $user->id,
                'name' => $subjek->subjek_pajak,
                'nip' => $subjek->npwpd,
                'nohp' => $subjek->nohp,
                'disabled' => true,
                'subjek_pajak_id' => $subjek->id,
            ]);

            DB::commit();
            return redirect()->route('wp.index')->with('success', 'Wajib Pajak berhasil didaftarkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }
}
