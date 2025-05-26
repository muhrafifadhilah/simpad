<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sptpd extends Model
{
    protected $table = 'sptpd';

    protected $fillable = [
        'objek_pajak_id',
        'subjek_pajak_id',
        'masa_pajak_awal',
        'masa_pajak_akhir',
        'jatuh_tempo',
        'dasar',
        'tarif',
        'denda',
        'bunga',
        'setoran',
        'lain_lain',
        'kenaikan',
        'kompensasi',
        'pajak_terutang',
        'omset_tapping_box',
    ];

    public function objekPajak()
    {
        return $this->belongsTo(ObjekPajak::class, 'objek_pajak_id');
    }

    public function subjekPajak()
    {
        return $this->belongsTo(SubjekPajak::class, 'subjek_pajak_id');
    }
}
