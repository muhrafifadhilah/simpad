<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upt extends Model
{
    use HasFactory;

    protected $table = 'upt';

    protected $fillable = [
        'no',
        'nama',
        'kepala_upt',
        'alamat',
        'status'
    ];

    public function kecamatans()
    {
        return $this->belongsToMany(Kecamatan::class, 'upt_has_kecamatan', 'upt_id', 'kecamatan_id');
    }
}
