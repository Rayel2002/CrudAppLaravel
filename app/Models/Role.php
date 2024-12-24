<?php

namespace App\Models;
use App\Models\Permission;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role',
        'permission_Id',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_Id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_Id');
    }
}
