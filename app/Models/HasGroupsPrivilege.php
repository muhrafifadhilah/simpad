<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasGroupsPrivilege extends Model
{
    protected $table = 'has_groups_privilege';

    protected $fillable = [
        'groups_user_id',
        'groups_privilege_id',
    ];

    public function groupUser()
    {
        return $this->belongsTo(GroupUser::class, 'groups_user_id');
    }

    public function groupPrivilege()
    {
        return $this->belongsTo(GroupPrivilege::class, 'groups_privilege_id');
    }
}
