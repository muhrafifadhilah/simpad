<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPrivilege extends Model
{
    protected $table = 'groups_privileges';

    protected $fillable = [
        'kode',
        'module',
        'baca',
        'tambah',
        'edit',
        'hapus',
    ];

    public function hasGroupsPrivileges()
    {
        return $this->hasMany(HasGroupsPrivilege::class, 'groups_privilege_id');
    }
}
