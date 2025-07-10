<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sptpd;
use App\Models\ObjekPajak;
use App\Models\SubjekPajak;
use App\Models\Upt;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class SptpdSeeder extends Seeder
{
    public function run()
    {
        $jenisList = [
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

        $objekList = ObjekPajak::with('subjekPajak')->get();
        $subjekList = SubjekPajak::all();
        $uptList = Upt::all();

        // Cek data tersedia sebelum seeding
        if ($objekList->isEmpty() || $subjekList->isEmpty() || $uptList->isEmpty()) {
            throw new \Exception('Objek Pajak, Subjek Pajak, dan UPT harus terisi sebelum menjalankan SptpdSeeder.');
        }

        $tahunList = [2024, 2025];
        $bulanList = range(1, 7); // hanya sampai Juli

        // Data 2025
        for ($i = 0; $i < 1000; $i++) {
            $jenis = Arr::random($jenisList);
            $target = $targetDummy[$jenis];
            $tahun = 2025;
            $bulan = Arr::random($bulanList);

            $subjek = $subjekList->random();
            $objekJenis = $objekList->where('jenis_pajak', $jenis);
            $objek = $objekJenis->isNotEmpty() ? $objekJenis->random() : $objekList->random();
            $objek->jenis_pajak = $jenis;
            $objek->save();
            $upt = $uptList->random();

            // Realisasi acak antara 75% - 90% target (sekitar 80%)
            $realisasi = (int)($target * (rand(0.5, 1.8) / 100));

            $masa_pajak_awal = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $masa_pajak_akhir = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            Sptpd::create([
                'objek_pajak_id' => $objek->id,
                'subjek_pajak_id' => $subjek->id,
                'upt_id' => $upt->id,
                'masa_pajak_awal' => $masa_pajak_awal,
                'masa_pajak_akhir' => $masa_pajak_akhir,
                'jatuh_tempo' => $masa_pajak_akhir->copy()->addDays(rand(1, 30)),
                'dasar' => $target,
                'tarif' => 10,
                'denda' => rand(0, 1000000),
                'bunga' => rand(0, 1000000),
                'setoran' => rand(0, 1000000),
                'lain_lain' => rand(0, 1000000),
                'kenaikan' => rand(0, 1000000),
                'kompensasi' => rand(0, 1000000),
                'pajak_terutang' => $realisasi,
                'omset_tapping_box' => rand(0, $realisasi),
            ]);
        }

        // Data 2024
        for ($i = 0; $i < 1000; $i++) {
            $jenis = Arr::random($jenisList);
            $target = $targetDummy[$jenis];
            $tahun = 2024;
            $bulan = Arr::random($bulanList);

            $subjek = $subjekList->random();
            $objekJenis = $objekList->where('jenis_pajak', $jenis);
            $objek = $objekJenis->isNotEmpty() ? $objekJenis->random() : $objekList->random();
            $objek->jenis_pajak = $jenis;
            $objek->save();
            $upt = $uptList->random();

            // Realisasi acak antara 75% - 90% target (sekitar 80%)
            $realisasi = (int)($target * (rand(0.5, 1.9) / 100));

            $masa_pajak_awal = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $masa_pajak_akhir = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            Sptpd::create([
                'objek_pajak_id' => $objek->id,
                'subjek_pajak_id' => $subjek->id,
                'upt_id' => $upt->id,
                'masa_pajak_awal' => $masa_pajak_awal,
                'masa_pajak_akhir' => $masa_pajak_akhir,
                'jatuh_tempo' => $masa_pajak_akhir->copy()->addDays(rand(1, 30)),
                'dasar' => $target,
                'tarif' => 10,
                'denda' => rand(0, 1000000),
                'bunga' => rand(0, 1000000),
                'setoran' => rand(0, 1000000),
                'lain_lain' => rand(0, 1000000),
                'kenaikan' => rand(0, 1000000),
                'kompensasi' => rand(0, 1000000),
                'pajak_terutang' => $realisasi,
                'omset_tapping_box' => rand(0, $realisasi),
            ]);
        }
    }
}
