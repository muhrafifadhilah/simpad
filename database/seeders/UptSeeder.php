<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Upt;

class UptSeeder extends Seeder
{
    public function run()
    {
        $uptList = [
            [
                'no' => 1,
                'nama' => 'UPT Pajak Wilayah I Cibinong',
                'kepala_upt' => 'Budi Santoso',
                'alamat' => 'Jl. Raya Jakarta-Bogor KM 46, Cibinong',
                'status' => true,
            ],
            [
                'no' => 2,
                'nama' => 'UPT Pajak Wilayah II Cileungsi',
                'kepala_upt' => 'Siti Aminah',
                'alamat' => 'Jl. Raya Cileungsi, Cileungsi',
                'status' => true,
            ],
            [
                'no' => 3,
                'nama' => 'UPT Pajak Wilayah III Parung',
                'kepala_upt' => 'Agus Salim',
                'alamat' => 'Jl. Raya Parung, Parung',
                'status' => true,
            ],
            [
                'no' => 4,
                'nama' => 'UPT Pajak Wilayah IV Leuwiliang',
                'kepala_upt' => 'Dewi Lestari',
                'alamat' => 'Jl. Raya Leuwiliang, Leuwiliang',
                'status' => true,
            ],
            [
                'no' => 5,
                'nama' => 'UPT Pajak Wilayah V Ciawi',
                'kepala_upt' => 'Rudi Hartono',
                'alamat' => 'Jl. Raya Ciawi, Ciawi',
                'status' => true,
            ],
            [
                'no' => 6,
                'nama' => 'UPT Pajak Wilayah VI Cigudeg',
                'kepala_upt' => 'Sri Wahyuni',
                'alamat' => 'Jl. Raya Cigudeg, Cigudeg',
                'status' => true,
            ],
            [
                'no' => 7,
                'nama' => 'UPT Pajak Wilayah VII Jonggol',
                'kepala_upt' => 'Tono Supriyadi',
                'alamat' => 'Jl. Raya Jonggol, Jonggol',
                'status' => true,
            ],
            [
                'no' => 8,
                'nama' => 'UPT Pajak Wilayah VIII Cisarua',
                'kepala_upt' => 'Yani Suryani',
                'alamat' => 'Jl. Raya Puncak, Cisarua',
                'status' => true,
            ],
        ];

        foreach ($uptList as $upt) {
            Upt::create($upt);
        }
    }
}
