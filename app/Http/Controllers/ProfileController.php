<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\SubjekPajak;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile user
     */
    public function index()
    {
        $user = Auth::user();
        $profileData = $this->getProfileData($user);
        
        return view('profile.index', compact('user', 'profileData'));
    }

    /**
     * Update profile user
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $role = $user->role->name;

        // Validasi umum
        $rules = [
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ];

        // Validasi spesifik per role
        if ($role === 'pegawai') {
            $rules['nama'] = 'required|string|max:255';
            $rules['nip'] = 'required|string|max:255';
            $rules['jabatan'] = 'required|string|max:255';
        } elseif ($role === 'wp') {
            $rules['pemilik'] = 'required|string|max:255';
            $rules['alamat'] = 'required|string|max:500';
            $rules['nohp'] = 'required|string|max:20';
            $rules['email'] = 'required|email|max:255';
        }

        $validated = $request->validate($rules);

        // Update password jika diisi
        if ($request->filled('password')) {
            if (!$request->filled('current_password')) {
                throw ValidationException::withMessages([
                    'current_password' => 'Password saat ini wajib diisi untuk mengubah password.'
                ]);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Password saat ini tidak sesuai.'
                ]);
            }

            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update data spesifik role
        if ($role === 'pegawai' && $user->pegawai) {
            $user->pegawai->update([
                'nama' => $validated['nama'],
                'nip' => $validated['nip'],
                'jabatan' => $validated['jabatan'],
            ]);
        } elseif ($role === 'wp' && $user->subjekPajak) {
            $user->subjekPajak->update([
                'pemilik' => $validated['pemilik'],
                'alamat' => $validated['alamat'],
                'nohp' => $validated['nohp'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Mendapatkan data profile berdasarkan role
     */
    private function getProfileData($user)
    {
        $role = $user->role->name;
        $profileData = [
            'role_display' => ucfirst($role),
            'created_at' => $user->created_at,
        ];

        switch ($role) {
            case 'psi':
                $profileData['description'] = 'Petugas Sistem Informasi';
                $profileData['permissions'] = [
                    'Akses Executive Summary',
                    'Kelola B-TAX',
                    'Kelola Pendaftaran (Subjek & Objek Pajak)',
                    'Kelola Pendataan (SPTPD)',
                    'Kelola Data Kecamatan',
                    'Kelola Data UPT'
                ];
                break;

            case 'upt':
                $profileData['description'] = 'Petugas Unit Pelaksana Teknis';
                $profileData['permissions'] = [
                    'Akses Executive Summary',
                    'Kelola B-TAX',
                    'Kelola Pendaftaran (Subjek & Objek Pajak)',
                    'Kelola Pendataan (SPTPD)',
                    'Kelola Data Kecamatan',
                    'Kelola Data UPT'
                ];
                break;

            case 'pegawai':
                $profileData['description'] = 'Pegawai Bapenda';
                $profileData['permissions'] = [
                    'Akses Executive Summary',
                    'Kelola Pendaftaran (Subjek & Objek Pajak)',
                    'Kelola Pendataan (SPTPD)'
                ];
                
                // Ambil data pegawai jika ada
                if ($user->pegawai) {
                    $profileData['pegawai'] = $user->pegawai;
                }
                break;

            case 'wp':
                $profileData['description'] = 'Wajib Pajak';
                $profileData['permissions'] = [
                    'Akses Dashboard Pribadi',
                    'Kelola SPTPD Sendiri',
                    'Bayar Pajak Online',
                    'Cetak Bukti Pembayaran'
                ];
                
                // Ambil data subjek pajak jika ada
                if ($user->subjekPajak) {
                    $profileData['subjek_pajak'] = $user->subjekPajak;
                }
                break;
        }

        return $profileData;
    }
}
