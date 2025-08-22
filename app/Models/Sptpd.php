<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sptpd extends Model
{
    protected $table = 'sptpd';

    protected $fillable = [
        'nomor_sptpd',
        'objek_pajak_id',
        'subjek_pajak_id',
        'upt_id',
        'tanggal_terima',
        'masa_pajak_awal',
        'masa_pajak_akhir',
        'jatuh_tempo',
        'total_pajak_terutang',
        'keterangan',
        'status',
    ];

    public function objekPajak()
    {
        return $this->belongsTo(ObjekPajak::class, 'objek_pajak_id');
    }

    public function subjekPajak()
    {
        return $this->belongsTo(SubjekPajak::class, 'subjek_pajak_id');
    }

    public function upt()
    {
        return $this->belongsTo(Upt::class, 'upt_id');
    }

    // Accessor untuk format mata uang
    public function getFormattedTotalPajakAttribute()
    {
        return number_format($this->total_pajak_terutang, 0, ',', '.');
    }

    // Accessor untuk nomor SPTPD otomatis
    public function getGeneratedNomorSptpdAttribute()
    {
        $date = $this->created_at ?? now();
        $idFormatted = str_pad($this->id, 5, '0', STR_PAD_LEFT);
        return $date->format('Y.m.d') . '.' . $idFormatted;
    }
}
