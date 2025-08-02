<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\SubjekPajak;
use App\Models\Wp;
use App\Models\Kecamatan;
use App\Models\Sptpd;
use App\Models\ObjekPajak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan role terlebih dahulu

        $psiRole = Role::firstOrCreate(['name' => 'psi']);
        $pegawaiRole = Role::firstOrCreate(['name' => 'pegawai']);
        $wpRole = Role::firstOrCreate(['name' => 'wp']);

        // Tambahkan pengguna dengan role admin

        // Tambahkan pengguna PSI
        User::firstOrCreate(
            ['userid' => 'psi001'],
            [
                'password' => Hash::make('psi123'),
                'role_id' => $psiRole->id
            ]
        );

        // Tambahkan pengguna Pegawai
        User::firstOrCreate(
            ['userid' => 'pegawai001'],
            [
                'password' => Hash::make('pegawai123'),
                'role_id' => $pegawaiRole->id
            ]
        );

        // Seed Kecamatan jika belum ada
        $kecamatans = [
            ['kode' => 'KEC001', 'nama' => 'Bogor Utara'],
            ['kode' => 'KEC002', 'nama' => 'Bogor Selatan'],
            ['kode' => 'KEC003', 'nama' => 'Bogor Timur'],
            ['kode' => 'KEC004', 'nama' => 'Bogor Barat'],
            ['kode' => 'KEC005', 'nama' => 'Bogor Tengah'],
            ['kode' => 'KEC006', 'nama' => 'Tanah Sereal']
        ];

        foreach ($kecamatans as $kecamatan) {
            Kecamatan::firstOrCreate(
                ['kode' => $kecamatan['kode']],
                [
                    'nama' => $kecamatan['nama'],
                    'tmt' => now(),
                    'status' => true
                ]
            );
        }

        // Seed Sample Subjek Pajak dengan Akun WP
        $this->seedSubjekPajakWithWp($wpRole);
        
        // Seed Objek Pajak
        $this->seedObjekPajak();
        
        // Seed Sample SPTPD
        $this->seedSptpd();
    }

    private function seedObjekPajak()
    {
        // Struktur tabel objek_pajak berbeda, ini akan diubah kemudian
        // Untuk saat ini kita skip dulu seeding objek pajak
        return;
    }

    private function seedSptpd()
    {
        // Ambil semua subjek pajak yang sudah dibuat
        $subjekPajaks = SubjekPajak::all();
        
        // Ambil beberapa objek pajak yang tersedia
        $objekPajakIds = [184, 192, 188, 195, 191]; // PBB, Hotel, Reklame, Restoran, Parkir

        foreach ($subjekPajaks as $index => $subjek) {
            // Buat 2-3 SPTPD untuk setiap subjek pajak
            for ($i = 0; $i < rand(2, 4); $i++) {
                $tanggal = now()->subMonths($i + 1);
                $masaPajakAwal = $tanggal->copy()->startOfMonth();
                $masaPajakAkhir = $tanggal->copy()->endOfMonth();
                
                $nomorSptpd = 'SPTPD-' . $tanggal->format('Ymd') . '-' . str_pad(($index + 1) * 10 + $i, 4, '0', STR_PAD_LEFT);
                
                // Generate random omzet
                $baseOmzet = rand(5000000, 100000000);
                $tarif = 10; // Default 10%
                $pajakTerutang = ($baseOmzet * $tarif) / 100;
                
                // Random objek pajak ID
                $objekPajakId = $objekPajakIds[array_rand($objekPajakIds)];
                
                // Random status
                $statuses = ['Draft', 'Terkirim', 'Lunas'];
                if ($i == 0) {
                    $status = 'Draft'; // SPTPD terbaru masih draft
                } else {
                    $status = $statuses[array_rand($statuses)];
                }
                
                Sptpd::firstOrCreate(
                    ['nomor_sptpd' => $nomorSptpd],
                    [
                        'objek_pajak_id' => $objekPajakId,
                        'subjek_pajak_id' => $subjek->id,
                        'upt_id' => 1, // Default UPT ID
                        'masa_pajak_awal' => $masaPajakAwal,
                        'masa_pajak_akhir' => $masaPajakAkhir,
                        'jatuh_tempo' => $masaPajakAkhir->copy()->addDays(30),
                        'dasar' => $baseOmzet,
                        'tarif' => $tarif,
                        'pajak_terutang' => $pajakTerutang,
                        'status' => $status,
                        'denda' => $status == 'Terkirim' && $masaPajakAkhir->addDays(30)->isPast() ? $pajakTerutang * 0.02 : 0,
                        'bunga' => 0,
                        'setoran' => $status == 'Lunas' ? $pajakTerutang : 0,
                        'lain_lain' => 0,
                        'kenaikan' => 0,
                        'kompensasi' => 0,
                        'omset_tapping_box' => 0,
                        'created_at' => $tanggal,
                        'updated_at' => $tanggal,
                    ]
                );
            }
        }
    }

    private function seedSubjekPajakWithWp($wpRole)
    {
        $sampleData = [
            [
                'pemilik' => 'PT Maju Jaya',
                'subjek_pajak' => 'PT Maju Jaya',
                'alamat' => 'Jl. Raya Bogor No. 123',
                'kecamatan' => 'Bogor Utara',
                'kelurahan' => 'Tegal Lega',
                'nohp' => '081234567890',
                'email' => 'majujaya@email.com',
                'pribadi_badan' => 'badan'
            ],
            [
                'pemilik' => 'Budi Santoso',
                'subjek_pajak' => 'Toko Budi',
                'alamat' => 'Jl. Sudirman No. 45',
                'kecamatan' => 'Bogor Selatan',
                'kelurahan' => 'Empang',
                'nohp' => '081234567891',
                'email' => 'budi@email.com',
                'pribadi_badan' => 'pribadi'
            ],
            [
                'pemilik' => 'Sari Dewi',
                'subjek_pajak' => 'Warung Sari',
                'alamat' => 'Jl. Pajajaran No. 67',
                'kecamatan' => 'Bogor Timur',
                'kelurahan' => 'Baranangsiang',
                'nohp' => '081234567892',
                'email' => 'sari@email.com',
                'pribadi_badan' => 'pribadi'
            ]
        ];

        foreach ($sampleData as $index => $data) {
            // Generate data yang diperlukan
            $tanggal = now()->subDays($index);
            $no_form = 'SUBJ-' . $tanggal->format('Ymd') . '-' . strtoupper(substr(md5($data['pemilik']), 0, 4));
            $npwpd = $tanggal->format('Ymd') . '-' . strtoupper(substr(md5($data['pemilik']), 0, 4));

            // Buat Subjek Pajak
            $subjekPajak = SubjekPajak::firstOrCreate(
                ['npwpd' => $npwpd],
                [
                    'no_form' => $no_form,
                    'tanggal' => $tanggal,
                    'pribadi_badan' => $data['pribadi_badan'],
                    'pemilik' => $data['pemilik'],
                    'subjek_pajak' => $data['subjek_pajak'],
                    'alamat' => $data['alamat'],
                    'kecamatan' => $data['kecamatan'],
                    'kelurahan' => $data['kelurahan'],
                    'kabupaten' => 'Bogor',
                    'kode_pos' => '16100',
                    'nohp' => $data['nohp'],
                    'email' => $data['email'],
                    'noPengukuhan' => 'PK-' . $tanggal->format('Ymd') . '-' . ($index + 1),
                    'tanggalPengukuhan' => $tanggal,
                    'pejabat' => 'Kepala Bapenda Kota Bogor',
                ]
            );

            // Buat User untuk WP
            $wpUser = User::firstOrCreate(
                ['userid' => $npwpd],
                [
                    'password' => Hash::make('wp2025'),
                    'role_id' => $wpRole->id
                ]
            );

            // Buat record WP
            $nip = 'WP-' . $tanggal->format('Ymd') . '-' . str_pad($subjekPajak->id, 4, '0', STR_PAD_LEFT);
            
            Wp::firstOrCreate(
                ['subjek_pajak_id' => $subjekPajak->id],
                [
                    'user_id' => $wpUser->id,
                    'name' => $data['pemilik'],
                    'nip' => $nip,
                    'nohp' => $data['nohp'],
                    'disabled' => false,
                ]
            );
        }
    }
}
