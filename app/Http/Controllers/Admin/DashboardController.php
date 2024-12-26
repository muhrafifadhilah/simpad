<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard umum.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard'); // Bisa disesuaikan jika ada dashboard umum
    }

    /**
     * Menampilkan halaman admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        $taxData = [
            [
                'jenisPajak' => 'PBJT atas Jasa Perhotelan',
                'targetAnggaran' => 151629301000,
                'realisasi' => 158011169345,
            ],
            [
                'jenisPajak' => 'PBJT atas Makanan dan / atau Minuman',
                'targetAnggaran' => 366233732000,
                'realisasi' => 374641538546,
            ],
            [
                'jenisPajak' => 'PBJT atas Jasa Kesenian dan Hiburan',
                'targetAnggaran' => 84646989000,
                'realisasi' => 89206019219,
            ],
            [
                'jenisPajak' => 'Pajak Reklame',
                'targetAnggaran' => 28415110000,
                'realisasi' => 31113737641,
            ],
            [
                'jenisPajak' => 'PBJT atas Tenaga Listrik',
                'targetAnggaran' => 413572579717,
                'realisasi' => 416710893098,
            ],
            [
                'jenisPajak' => 'PBJT atas Jasa Parkir',
                'targetAnggaran' => 13000474104,
                'realisasi' => 13209849022,
            ],
            [
                'jenisPajak' => 'PBJT Air Tanah',
                'targetAnggaran' => 65976059194,
                'realisasi' => 67298597958,
            ],
            [
                'jenisPajak' => 'PBJT Mineral Bukan Logan Dan Batuan',
                'targetAnggaran' => 116004045544,
                'realisasi' => 121927144091,
            ],
        ];

        return view('admin.dashboard.index', compact('taxData'));
    }

    /**
     * Menampilkan halaman user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        return view('user.dashboard.index'); // Sesuaikan lokasi file view untuk user dashboard
    }
}
