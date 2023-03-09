<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "admins";
//    protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;
        if (!$role)
            return false;

        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } elseif (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }

}
