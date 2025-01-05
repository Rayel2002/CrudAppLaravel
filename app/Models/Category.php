<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Relatie met Types
    public function types()
    {
        return $this->hasMany(Type::class, 'category_Id');
    }
}


