<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubjekPajak;

class SubjekPajakSeeder extends Seeder
{
    public function run()
    {
        $kecamatanList = [
            'Cibinong', 'Citeureup', 'Gunung Putri', 'Sukaraja', 'Babakan Madang',
            'Bojonggede', 'Cileungsi', 'Jonggol', 'Cariu', 'Sukamakmur',
            'Parung', 'Gunung Sindur', 'Kemang', 'Ranca Bungur', 'Ciseeng',
            'Ciampea', 'Cibungbulang', 'Leuwiliang', 'Leuwisadeng', 'Nanggung',
            'Dramaga', 'Tenjolaya', 'Cigudeg', 'Sukajaya', 'Jasinga',
            'Parung Panjang', 'Tenjo', 'Rumpin', 'Caringin', 'Cijeruk',
            'Ciomas', 'Tamansari', 'Megamendung', 'Cisarua', 'Ciawi',
            'Pamijahan'
        ];

        for ($i = 1; $i <= 100; $i++) {
            SubjekPajak::create([
                'subjek_pajak' => "Subjek Pajak $i",
                'pemilik' => "Pemilik $i",
                'npwpd' => "32.74.{$i}",
                'alamat' => "Alamat $i",
                'kecamatan' => $kecamatanList[array_rand($kecamatanList)],
                'kelurahan' => "Kelurahan $i",
                'kabupaten' => "Bogor",
                'kode_pos' => "16" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nohp' => "0812" . rand(10000000, 99999999),
                'email' => "subjek$i@email.com",
                'no_form' => "F-".str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal' => now(),
                'pribadi_badan' => rand(0,1) ? 'pribadi' : 'badan',
                'noPengukuhan' => "PKH-".str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggalPengukuhan' => now(),
                'pejabat' => "Pejabat $i",
            ]);
        }
    }
}
