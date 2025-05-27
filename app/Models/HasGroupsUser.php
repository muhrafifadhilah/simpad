<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasGroupsUser extends Model
{
    protected $table = 'has_groups_user';

    protected $fillable = [
        'wp_id',
        'groups_user_id',
    ];

    public function wp()
    {
        return $this->belongsTo(Wp::class, 'wp_id');
    }

    public function groupUser()
    {
        return $this->belongsTo(GroupUser::class, 'groups_user_id');
    }
}
