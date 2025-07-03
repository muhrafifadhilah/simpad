<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'kode',
        'nama',
        'tmt',
        'status'
    ];

    public function UptHasKecamatan()
    {
        return $this->belongsTo(Upt_has_kecamatan::class, 'kecamatan_id');
    }

    public function upts()
    {
        return $this->belongsToMany(Upt::class, 'upt_has_kecamatan', 'kecamatan_id', 'upt_id');
    }
}