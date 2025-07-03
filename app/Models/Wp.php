<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wp extends Model
{
    protected $table = 'wp';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'nohp',
        'disabled',
        'subjek_pajak_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subjekPajak()
    {
        return $this->hasOne(SubjekPajak::class, 'subjek_pajak_id');
    }
}
