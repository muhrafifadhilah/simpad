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
        $pegawaiUser = User::firstOrCreate(
            ['userid' => 'pegawai001'],
            [
                'password' => Hash::make('pegawai123'),
                'role_id' => $pegawaiRole->id
            ]
        );

        // Tambahkan data pegawai
        \App\Models\Pegawai::firstOrCreate(
            ['user_id' => $pegawaiUser->id],
            [
                'nama' => 'Ahmad Subandi',
                'nip' => '196512101985031001',
                'jabatan' => 'Staff Pendataan Pajak'
            ]
        );

        // Seed Kecamatan jika belum ada
        $kecamatans = [
            ['kode' => '001', 'nama' => 'Gunung Putri'],
            ['kode' => '002', 'nama' => 'Cisarua'],
            ['kode' => '003', 'nama' => 'Ciomas'],
            ['kode' => '004', 'nama' => 'Parung'],
            ['kode' => '005', 'nama' => 'Citereup'],
            ['kode' => '006', 'nama' => 'Ciawi']
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

        // Note: Subjek Pajak, Objek Pajak, dan SPTPD akan di-seed oleh seeder masing-masing
    }

}
