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

        $kategoriUsahaList = [
            'Restoran/Rumah Makan',
            'Warung/Kedai',
            'Hotel/Penginapan',
            'Salon/Barbershop',
            'Bengkel',
            'Toko/Minimarket',
            'Apotek',
            'Fotocopy/Printing',
            'Laundry',
            'Cafe/Warung Kopi',
            'Elektronik',
            'Fashion/Clothing',
            'Rental Kendaraan',
            'Jasa Service'
        ];

        $subjekList = SubjekPajak::all();

        // Pastikan setiap subjek pajak memiliki minimal 1 objek pajak
        foreach ($subjekList as $index => $subjek) {
            // Buat 1-3 objek pajak untuk setiap subjek pajak
            $jumlahObjek = rand(1, 3);
            
            for ($j = 1; $j <= $jumlahObjek; $j++) {
                $jenis = $jenisList[array_rand($jenisList)];
                $kategori = $kategoriUsahaList[array_rand($kategoriUsahaList)];
                $nomorObjek = ($index * 10) + $j; // Unique numbering
                
                // Tentukan nama usaha berdasarkan subjek pajak
                $namaUsaha = $subjek->subjek_pajak;
                if ($j > 1) {
                    $namaUsaha .= " Cabang $j";
                }
                
                ObjekPajak::create([
                    'subjek_pajak_id' => $subjek->id,
                    'nopd' => "32.74." . str_pad($nomorObjek, 6, '0', STR_PAD_LEFT),
                    'nama_usaha' => $namaUsaha,
                    'kategori_usaha' => $kategori,
                    'jenis_usaha' => $kategori,
                    'jenis_pajak' => $jenis,
                    'kecamatan' => $subjek->kecamatan,
                    'kelurahan' => $subjek->kelurahan,
                    'alamat' => $subjek->alamat . ($j > 1 ? " Blok $j" : ''),
                    'keterangan' => "Objek pajak untuk {$subjek->pemilik}" . ($j > 1 ? " - Unit $j" : ''),
                    'status' => 'aktif',
                    'status_tmt' => now()->subDays(rand(1, 180)),
                ]);
            }
        }

        // Tambahan objek pajak random untuk variasi data
        for ($i = 1; $i <= 50; $i++) {
            $subjek = $subjekList->random();
            $jenis = $jenisList[array_rand($jenisList)];
            $kategori = $kategoriUsahaList[array_rand($kategoriUsahaList)];
            
            ObjekPajak::create([
                'subjek_pajak_id' => $subjek->id,
                'nopd' => "32.74." . str_pad((1000 + $i), 6, '0', STR_PAD_LEFT),
                'nama_usaha' => $subjek->subjek_pajak . " Unit Tambahan",
                'kategori_usaha' => $kategori,
                'jenis_usaha' => $kategori,
                'jenis_pajak' => $jenis,
                'kecamatan' => $subjek->kecamatan,
                'kelurahan' => $subjek->kelurahan,
                'alamat' => $subjek->alamat . " Unit Tambahan",
                'keterangan' => "Unit tambahan untuk {$subjek->pemilik}",
                'status' => 'aktif',
                'status_tmt' => now()->subDays(rand(1, 90)),
            ]);
        }
    }
}
