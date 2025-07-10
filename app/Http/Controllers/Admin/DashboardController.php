<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\DashboardTaxUpdate;
use App\Models\Sptpd;

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
        $allJenis = [
            'PBJT atas Jasa Perhotelan',
            'PBJT atas Makanan dan / atau Minuman',
            'PBJT atas Jasa Kesenian dan Hiburan',
            'Pajak Reklame',
            'PBJT atas Tenaga Listrik',
            'PBJT atas Jasa Parkir',
            'PBJT Air Tanah',
            'PBJT Mineral Bukan Logam Dan Batuan',
            'PBB',
            'BPHTB',
        ];

        $imgMap = [
            'PBJT atas Jasa Perhotelan' => '/assets/img/hotel.png',
            'PBJT atas Makanan dan / atau Minuman' => '/assets/img/makan.png',
            'PBJT atas Jasa Kesenian dan Hiburan' => '/assets/img/seni.png',
            'Pajak Reklame' => '/assets/img/reklame.png',
            'PBJT atas Tenaga Listrik' => '/assets/img/listrik.png',
            'PBJT atas Jasa Parkir' => '/assets/img/parkir.png',
            'PBJT Air Tanah' => '/assets/img/air.png',
            'PBJT Mineral Bukan Logam Dan Batuan' => '/assets/img/mineral.png',
            'PBB' => '/assets/img/pbb.png',
            'BPHTB' => '/assets/img/bphtb.png',
            '-' => '/assets/img/other.png',
        ];

        $targetDummy = [
            'PBJT atas Jasa Perhotelan' => 151629301000,
            'PBJT atas Makanan dan / atau Minuman' => 360633732000,
            'PBJT atas Jasa Kesenian dan Hiburan' => 80646989000,
            'Pajak Reklame' => 28415110000,
            'PBJT atas Tenaga Listrik' => 376582300000,
            'PBJT atas Jasa Parkir' => 8333241000,
            'PBJT Air Tanah' => 72440860000,
            'PBJT Mineral Bukan Logam Dan Batuan' => 122040128000,
            'PBB' => 640586110000,
            'BPHTB' => 990227628000,
        ];

        $uptList = \App\Models\Upt::all();

        // Ambil data SPTPD tahun 2025 untuk tabel detail per jenis pajak
        $sptpd = \App\Models\Sptpd::with(['objekPajak', 'subjekPajak'])
            ->whereYear('masa_pajak_awal', 2025)
            ->get();

        $grouped = $sptpd->groupBy(function($item) {
            $jenis = $item->objekPajak->jenis_pajak ?? '-';
            return trim($jenis);
        });

        $taxData = [];
        $taxData2 = [];
        $sptpdByJenis = [];

        $tahunLaluDummy = [
            'PBJT atas Jasa Perhotelan' => 144332162687,
            'PBJT atas Makanan dan / atau Minuman' => 312508124736,
            'PBJT atas Jasa Kesenian dan Hiburan' => 78309550432,
            'Pajak Reklame' => 26565469856,
            'PBJT atas Tenaga Listrik' => 144881930911,
            'PBJT atas Jasa Parkir' => 19210050276,
            'PBJT Air Tanah' => 69704094539,
            'PBJT Mineral Bukan Logam Dan Batuan' => 124214026545,
            'PBB' => 610390232793,
            'BPHTB' => 1043286166887,
        ];

        // Tambahkan definisi $bulan
        $bulan = [
            'januari', 'februari', 'maret', 'april', 'mei', 'juni',
            'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
        ];

        foreach ($allJenis as $jenis) {
            $items = $grouped[$jenis] ?? collect();
            $realisasi = $items->sum('pajak_terutang');

            // Hitung realisasi per UPT untuk filter
            $realisasi_by_upt = [];
            foreach ($uptList as $upt) {
                $realisasi_by_upt[$upt->id] = $items->where('upt_id', $upt->id)->sum('pajak_terutang');
            }

            $taxData[] = [
                'jenisPajak' => $jenis,
                'targetAnggaran' => $targetDummy[$jenis] ?? 0,
                'realisasi' => $realisasi,
                'tahunLalu' => $tahunLaluDummy[$jenis] ?? 0,
                'img' => $imgMap[$jenis] ?? $imgMap['-'],
                'realisasi_by_upt' => $realisasi_by_upt,
            ];
        }

        // Untuk taxData2 (per bulan)
        foreach ($allJenis as $jenis) {
            $items = $grouped[$jenis] ?? collect();
            $target = $targetDummy[$jenis] ?? 0;
            $targetTW = [
                1 => round($target * 0.25),
                2 => round($target * 0.25),
                3 => round($target * 0.25),
                4 => round($target * 0.25),
            ];
            $bulanData = [];
            foreach ($bulan as $i => $b) {
                $bulanData[$b] = $items->filter(function($item) use ($i) {
                    return \Carbon\Carbon::parse($item->masa_pajak_awal)->month == ($i+1);
                })->sum('pajak_terutang');
                // By UPT
                $byUpt = [];
                foreach ($uptList as $upt) {
                    $byUpt[$upt->id] = $items->filter(function($item) use ($i, $upt) {
                        return \Carbon\Carbon::parse($item->masa_pajak_awal)->month == ($i+1) && $item->upt_id == $upt->id;
                    })->sum('pajak_terutang');
                }
                $bulanData[$b.'_by_upt'] = $byUpt;
            }
            $taxData2[] = [
                'jenisPajak' => $jenis,
                'targetTW1' => $targetTW[1],
                'januari' => $bulanData['januari'],
                'februari' => $bulanData['februari'],
                'maret' => $bulanData['maret'],
                'targetTW2' => $targetTW[2],
                'april' => $bulanData['april'],
                'mei' => $bulanData['mei'],
                'juni' => $bulanData['juni'],
                'targetTW3' => $targetTW[3],
                'juli' => $bulanData['juli'],
                'agustus' => $bulanData['agustus'],
                'september' => $bulanData['september'],
                'targetTW4' => $targetTW[4],
                'oktober' => $bulanData['oktober'],
                'november' => $bulanData['november'],
                'desember' => $bulanData['desember'],
                // By UPT
                'januari_by_upt' => $bulanData['januari_by_upt'],
                'februari_by_upt' => $bulanData['februari_by_upt'],
                'maret_by_upt' => $bulanData['maret_by_upt'],
                'april_by_upt' => $bulanData['april_by_upt'],
                'mei_by_upt' => $bulanData['mei_by_upt'],
                'juni_by_upt' => $bulanData['juni_by_upt'],
                'juli_by_upt' => $bulanData['juli_by_upt'],
                'agustus_by_upt' => $bulanData['agustus_by_upt'],
                'september_by_upt' => $bulanData['september_by_upt'],
                'oktober_by_upt' => $bulanData['oktober_by_upt'],
                'november_by_upt' => $bulanData['november_by_upt'],
                'desember_by_upt' => $bulanData['desember_by_upt'],
            ];
        }

        // Untuk sptpdByJenis, tambahkan upt_id
        foreach ($grouped as $jenis => $items) {
            $sptpdByJenis[$jenis] = $items->map(function($row) {
                return [
                    'no_sptpd' => $row->id,
                    'tanggal' => $row->created_at ? $row->created_at->format('d-m-Y') : '',
                    'nopd' => $row->objekPajak->nopd ?? '-',
                    'subjek_pajak' => $row->subjekPajak->subjek_pajak ?? '-',
                    'masa_pajak' => ($row->masa_pajak_awal ? \Carbon\Carbon::parse($row->masa_pajak_awal)->format('M Y') : '') .
                        ($row->masa_pajak_akhir ? ' s/d ' . \Carbon\Carbon::parse($row->masa_pajak_akhir)->format('M Y') : ''),
                    'dasar' => $row->dasar,
                    'pajak_terutang' => $row->pajak_terutang,
                    'upt_id' => $row->upt_id,
                ];
            })->toArray();
        }

        return view('admin.dashboard.index', compact('taxData', 'taxData2', 'sptpdByJenis', 'uptList'));
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

    /**
     * Update data pajak dan memicu event.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTaxData(Request $request)
    {
        // Ambil data pajak terbaru dari database atau request
        $taxData = $request->input('taxData'); // atau generate dari DB

        // Broadcast event ke frontend
        event(new DashboardTaxUpdate($taxData));

        return response()->json(['success' => true]);
    }
}