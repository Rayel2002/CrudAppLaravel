<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'permission_Id';
    protected $fillable = ['permission'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_Id', 'role_Id');
    }
}
