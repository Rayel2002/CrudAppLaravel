<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'role_Id';
    protected $fillable = ['role'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_Id', 'permission_Id');
    }
}
