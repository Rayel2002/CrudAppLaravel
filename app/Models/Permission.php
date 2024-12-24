<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Permission extends Model
{
    protected $fillable = [
        'permission',
    ];

    public function roles()
    {
        return $this->hasMany(Role::class, 'permission_Id');
    }
}
