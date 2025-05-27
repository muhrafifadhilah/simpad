<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'groups_user';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function hasGroupsUsers()
    {
        return $this->hasMany(HasGroupsUser::class, 'groups_user_id');
    }

    public function hasGroupsPrivileges()
    {
        return $this->hasMany(HasGroupsPrivilege::class, 'groups_user_id');
    }
}
