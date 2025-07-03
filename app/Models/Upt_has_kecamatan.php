<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upt_has_kecamatan extends Model
{
    use HasFactory;

    protected $table = 'upt_has_kecamatan';

    protected $fillable = [
        'upt_id',
        'kecamatan_id',
    ];

    public function upt()
    {
        return $this->hasMany(Upt::class, 'upt_id');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kecamatan_id');
    }
}
