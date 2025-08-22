<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubjekPajak;
use App\Models\User;
use App\Models\Wp;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SubjekPajakSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role WP ada
        $wpRole = Role::firstOrCreate(['name' => 'wp']);

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

        $namaUsahaList = [
            'Warung Suka Sari', 'Toko Berkah Jaya', 'Rumah Makan Sederhana', 'Hotel Bogor Indah',
            'Restoran Padang Minang', 'Cafe Corner', 'Bengkel Motor Jaya', 'Salon Cantik',
            'Apotek Sehat', 'Toko Elektronik Maju', 'Warung Internet', 'Laundry Bersih',
            'Fotocopy Center', 'Minimarket Berkah', 'Warung Nasi Uduk', 'Bakso Malang',
            'Soto Betawi Enak', 'Gado-gado Jakarta', 'Es Campur Segar', 'Juice Corner',
            'Warung Kopi', 'Toko Baju Fashion', 'Sepatu Sport', 'Tas Import',
            'Handphone Shop', 'Komputer Service', 'Print Digital', 'Rental Mobil',
            'Ojek Online Base', 'Warung Mie Ayam', 'Bubur Ayam', 'Nasi Goreng Spesial',
            'Ayam Penyet', 'Pecel Lele', 'Gudeg Jogja', 'Rawon Surabaya',
            'Bakmi GM', 'Pizza Corner', 'Burger King', 'KFC Local',
            'Donat Kentang', 'Roti Bakar', 'Martabak Manis', 'Kerak Telor',
            'Sate Ayam Madura', 'Gule Kambing', 'Rendang Padang', 'Pempek Palembang'
        ];

        $pemilikList = [
            'Budi Santoso', 'Sari Dewi', 'Ahmad Fauzi', 'Rina Wati', 'Joko Widodo',
            'Ani Susanti', 'Bambang Suryanto', 'Lina Marlina', 'Hendra Gunawan', 'Maya Sari',
            'Dedi Kurniawan', 'Fitri Handayani', 'Agus Salim', 'Dewi Sartika', 'Rudi Hartono',
            'Sri Mulyani', 'Eko Prasetyo', 'Indah Permata', 'Yudi Setiawan', 'Nita Anggraini',
            'Wahyu Hidayat', 'Ratna Sari', 'Hadi Purnomo', 'Sinta Dewi', 'Benny Wijaya',
            'Dian Sastro', 'Andi Rahman', 'Lisa Andriani', 'Doni Saputra', 'Vina Panduwinata',
            'Tono Sukarno', 'Rini Soemarno', 'Ade Rai', 'Cindy Claudia', 'Ferry Salim',
            'Gita Gutawa', 'Haris Azhar', 'Ika Natassa', 'Jefri Nichol', 'Kirana Larasati',
            'Lukman Sardi', 'Maudy Ayunda', 'Nadya Hutagalung', 'Oka Antara', 'Prilly Latuconsina'
        ];

        for ($i = 1; $i <= 100; $i++) {
            $tanggal = now()->subDays(rand(1, 365));
            $kecamatan = $kecamatanList[array_rand($kecamatanList)];
            $namaUsaha = $namaUsahaList[array_rand($namaUsahaList)] . " $i";
            $pemilik = $pemilikList[array_rand($pemilikList)];
            $npwpd = "32.74." . str_pad($i, 6, '0', STR_PAD_LEFT);
            
            // Buat Subjek Pajak
            $subjekPajak = SubjekPajak::create([
                'subjek_pajak' => $namaUsaha,
                'pemilik' => $pemilik,
                'npwpd' => $npwpd,
                'alamat' => "Jl. Raya $kecamatan No. $i",
                'kecamatan' => $kecamatan,
                'kelurahan' => "Kelurahan " . $kecamatan . " $i",
                'kabupaten' => "Bogor",
                'kode_pos' => "16" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nohp' => "0812" . rand(10000000, 99999999),
                'email' => strtolower(str_replace(' ', '', $pemilik)) . $i . "@email.com",
                'no_form' => "F-".str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal' => $tanggal,
                'pribadi_badan' => rand(0,1) ? 'pribadi' : 'badan',
                'noPengukuhan' => "PKH-".str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggalPengukuhan' => $tanggal,
                'pejabat' => "Kepala Bapenda Bogor",
            ]);

            // Buat User untuk setiap Subjek Pajak
            $wpUser = User::firstOrCreate(
                ['userid' => $npwpd],
                [
                    'password' => Hash::make('wp123'),
                    'role_id' => $wpRole->id
                ]
            );

            // Buat record WP
            $nip = 'WP-' . $tanggal->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);
            
            Wp::firstOrCreate(
                ['subjek_pajak_id' => $subjekPajak->id],
                [
                    'user_id' => $wpUser->id,
                    'name' => $pemilik,
                    'nip' => $nip,
                    'nohp' => $subjekPajak->nohp,
                    'disabled' => false,
                ]
            );
        }
    }
}
