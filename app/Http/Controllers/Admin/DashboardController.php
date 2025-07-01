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
                'realisasi' => 127693708700,
                'img' => '/assets/img/hotel.png',
                'tahunLalu' => 144332162687,
            ],
            [
                'jenisPajak' => 'PBJT atas Makanan dan / atau Minuman',
                'targetAnggaran' => 360633732000,
                'realisasi' => 306739990533,
                'img' => '/assets/img/makan.png',
                'tahunLalu' => 312508124736,
            ],
            [
                'jenisPajak' => 'PBJT atas Jasa Kesenian dan Hiburan',
                'targetAnggaran' => 80646989000,
                'realisasi' => 75097658180,
                'img' => '/assets/img/seni.png',
                'tahunLalu' => 78309550432,
            ],
            [
                'jenisPajak' => 'Pajak Reklame',
                'targetAnggaran' => 28415110000,
                'realisasi' => 25404910752,
                'img' => '/assets/img/reklame.png',
                'tahunLalu' => 26565469856,
            ],
            [
                'jenisPajak' => 'PBJT atas Tenaga Listrik',
                'targetAnggaran' => 376582300000,
                'realisasi' => 144967881912,
                'img' => '/assets/img/listrik.png',
                'tahunLalu' => 144881930911,
            ],
            [
                'jenisPajak' => 'PBJT atas Jasa Parkir',
                'targetAnggaran' => 8333241000,
                'realisasi' => 10104254909,
                'img' => '/assets/img/parkir.png',
                'tahunLalu' => 19210050276,
            ],
            [
                'jenisPajak' => 'PBJT Air Tanah',
                'targetAnggaran' => 72440860000,
                'realisasi' => 50235343031,
                'img' => '/assets/img/air.png',
                'tahunLalu' => 69704094539,
            ],
            [
                'jenisPajak' => 'PBJT Mineral Bukan Logam Dan Batuan',
                'targetAnggaran' => 122040128000,
                'realisasi' => 99404593678,
                'img' => '/assets/img/mineral.png',
                'tahunLalu' => 124214026545,
            ],
            [
                'jenisPajak' => 'PBB',
                'targetAnggaran' => 640586111000,
                'realisasi' => 640070905760,
                'img' => '/assets/img/pbb.png',
                'tahunLalu' => 610390232793,
            ],
            [
                'jenisPajak' => 'BPHTB',
                'targetAnggaran' => 990227628000,
                'realisasi' => 771402638619,
                'img' => '/assets/img/bphtb.png',
                'tahunLalu' => 610390232793,
            ],
        ];

        $taxData2 = [
            [
              'jenisPajak' => 'BPHTB',
              'januari' => 53747304777,
              'februari' => 84144252818,
              'maret' => 80102074834,
              'april' => 91808258117,
              'mei' => 102189742341,
              'juni' => 201801713350,
              'juli' => 0,
              'agustus' => 0,
              'september' => 0,
              'oktober'=> 0,
              'november' => 0,
              'desember' => 0,
              'targetTW1' => 198500364675,
              'targetTW2' => 229423888165,
              'targetTW3' => 240996527404,
              'targetTW4' => 505797002254,
            ],
            [
              'jenisPajak'=> 'Pajak Air Tanah',
              'januari'=> 5365193602,
              'februari'=> 4919250074,
              'maret'=> 5354059800,
              'april'=> 4296875236,
              'mei'=> 3842953354,
              'juni'=> 5697573778,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 16744142803,
              'targetTW2'=> 15988563819,
              'targetTW3'=> 17395561091,
              'targetTW4'=> 17454288709,
            ],
            [
              'jenisPajak'=> 'Pajak Mineral Bukan Logam Dan Batuan',
              'januari'=> 10866773651,
              'februari'=> 12181456442,
              'maret'=> 10995679699,
              'april'=> 9948744510,
              'mei'=> 9679759592,
              'juni'=> 12041744478,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 28276337303,
              'targetTW2'=> 26937852125,
              'targetTW3'=> 30888250242,
              'targetTW4'=> 31514316096, 
            ],
            [
              'jenisPajak'=> 'Pajak Reklame',
              'januari'=> 1806776667,
              'februari'=> 2287531668,
              'maret'=> 4191654710, 
              'april'=> 1835711470,
              'mei'=> 1716021162,
              'juni'=> 2826833916, 
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 7577620490,
              'targetTW2'=> 7653084367,
              'targetTW3'=> 7818022838,
              'targetTW4'=> 11241715023,
            ],
            [
              'jenisPajak'=> 'PBB P2',
              'januari'=> 14955885610,
              'februari'=> 72350040100,
              'maret'=> 193887371900,
              'april'=> 45735681936,
              'mei'=> 67173160283,
              'juni'=> 70323938255,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 238571324435,
              'targetTW2'=> 204394054689,
              'targetTW3'=> 181561694129,
              'targetTW4'=> 55871860551,
            ],
            [
              'jenisPajak'=> 'PBJT atas Jasa Kesenian dan Hiburan',
              'januari'=> 8794498390,
              'februari'=> 7735624131,
              'maret'=> 5443872995,
              'april'=> 3388043465,
              'mei'=> 10387660012,
              'juni'=> 7548976187,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 20899848950,
              'targetTW2'=> 19319649490,
              'targetTW3'=> 23827439361,
              'targetTW4'=> 24335479259,
            ],
            [
              'jenisPajak'=> 'PBJT atas Jasa Parkir',
              'januari'=> 1248935428,
              'februari'=> 1181643875,
              'maret'=> 980465188,
              'april'=> 1170694938,
              'mei'=> 1317471373,
              'juni'=> 1265442368,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 3272163862,
              'targetTW2'=> 3449578804,
              'targetTW3'=> 3308609591,
              'targetTW4'=> 3559942330,
            ],
            [
              'jenisPajak'=> 'PBJT atas Jasa Perhotelan',
              'januari'=> 17523371181,
              'februari'=> 14448358966,
              'maret'=> 10635445555,
              'april'=> 6124653204,
              'mei'=> 10322203055,
              'juni'=> 10930681093,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 40333725629,
              'targetTW2'=> 36256765557,
              'targetTW3'=> 41582185546,
              'targetTW4'=> 41921136241,
            ],
            [
              'jenisPajak'=> 'PBJT atas Makanan dan / atau Minuman',
              'januari'=> 40116697307,
              'februari'=> 39344400852,
              'maret'=> 28054766358,
              'april'=> 29284304618,
              'mei'=> 35020394431,
              'juni'=> 34506911700,
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 95263721585,
              'targetTW2'=> 94965755845,
              'targetTW3'=> 96977489425,
              'targetTW4'=> 92878496248,
            ],
            [
              'jenisPajak'=> 'PBJT atas Tenaga Listrik',
              'januari'=> 34495389908,
              'februari'=> 34699458040,
              'maret'=> 33085105305,
              'april'=> 28851936325,
              'mei'=> 31228531505,
              'juni'=> 28317279242, 
              'juli'=> 0,
              'agustus'=> 0,
              'september'=> 0,
              'oktober'=> 0,
              'november'=> 0,
              'desember'=> 0,
              'targetTW1'=> 96944875642,
              'targetTW2'=> 106322655649,
              'targetTW3'=> 107923105693,
              'targetTW4'=> 110549177960,
            ],
          ];

        return view('admin.dashboard.index', compact('taxData', 'taxData2'));
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
