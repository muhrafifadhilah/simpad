<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Sptpd;

class WpDashboardController extends Controller
{
    public function index()
    {
        return view('wp.dashboard');
    }

    public function sptpd()
    {
        $wp = Auth::user()->wp;
        $subjekPajakId = $wp->subjek_pajak_id ?? null;
        $sptpd = Sptpd::where('subjek_pajak_id', $subjekPajakId)->get();
        return view('wp.sptpd', compact('sptpd'));
    }
}
