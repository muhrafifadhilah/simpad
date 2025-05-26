<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPrivilege extends Model
{
    protected $table = 'groups_privileges';

    protected $fillable = [
        'group_id',
        'kode',
        'module',
        'baca',
        'tambah',
        'edit',
        'hapus',
    ];

    public function group()
    {
        return $this->belongsTo(GroupUser::class, 'group_id');
    }
}
