<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wp extends Model
{
    protected $table = 'wp';

    protected $fillable = [
        'user_id',
        'subjek_pajak_id',
        'name',
        'nip',
        'nohp',
        'disabled',
    ];

    protected $casts = [
        'disabled' => 'boolean',
    ];

    public function subjekPajak()
    {
        return $this->belongsTo(SubjekPajak::class, 'subjek_pajak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
