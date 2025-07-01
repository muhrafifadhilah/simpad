<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
