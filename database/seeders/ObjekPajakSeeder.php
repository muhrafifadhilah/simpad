<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObjekPajak;
use App\Models\SubjekPajak;

class ObjekPajakSeeder extends Seeder
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

        $subjekList = SubjekPajak::all();

        for ($i = 1; $i <= 200; $i++) {
            $subjek = $subjekList->random();
            $jenis = $jenisList[array_rand($jenisList)];
            ObjekPajak::create([
                'subjek_pajak_id' => $subjek->id,
                'nopd' => "NOPD-".str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama_usaha' => "Usaha $i",
                'kategori_usaha' => $jenis,
                'jenis_usaha' => $jenis,
                'jenis_pajak' => $jenis,
                'kecamatan' => $subjek->kecamatan,
                'kelurahan' => $subjek->kelurahan,
                'alamat' => $subjek->alamat,
                'keterangan' => "Keterangan $i",
                'status' => 'aktif',
                'status_tmt' => now(),
            ]);
        }
    }
}
