<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'groups_user';

    protected $fillable = [
        'user_id',
        'kode',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function privileges()
    {
        return $this->hasMany(GroupPrivilege::class, 'group_id');
    }
}
