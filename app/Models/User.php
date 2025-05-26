<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "userid",
        "role_id",
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function wps()
    {
        return $this->hasMany(Wp::class);
    }

    public function psis()
    {
        return $this->hasMany(Psi::class);
    }

    public static function validateCredentials($userid, $password)
    {
        $user = self::where('userid', $userid)->first();
        
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        
        return null;
    }
}