<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjekPajak extends Model
{
    protected $table = 'subjek_pajak';

    protected $fillable = [
        'no_form',
        'tanggal',
        'pribadi/badan',
        'subjek_pajak',
        'nama',
        'alamat',
        'kecamatan',
        'kelurahan',
        'kabupaten',
        'kode_pos',
        'nohp',
        'email',
        'npwpd',
        'noPengukuhan',
        'tanggalPengukuhan',
        'pejabat',
    ];

    public function objekPajaks()
    {
        return $this->hasMany(ObjekPajak::class, 'subjek_pajak_id');
    }
}
