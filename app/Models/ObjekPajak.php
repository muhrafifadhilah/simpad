<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekPajak extends Model
{
    protected $table = 'objek_pajak';

    protected $fillable = [
        'subjek_pajak_id',
        'nopd',
        'nama_usaha',
        'kategori_usaha',
        'jenis_usaha',
        'jenis_pajak',
        'kecamatan',
        'kelurahan',
        'alamat',
        'keterangan',
        'langtitude',
        'longitude',
        'status',
        'status_tmt',
        'foto',
    ];

    public function subjekPajak()
    {
        return $this->belongsTo(SubjekPajak::class, 'subjek_pajak_id');
    }

    public function sptpds()
    {
        return $this->hasMany(Sptpd::class, 'objek_pajak_id');
    }
}
