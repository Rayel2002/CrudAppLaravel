<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'category_Id'];

    // Specificeer de primaire sleutel
    protected $primaryKey = 'type_Id';

    // Relatie met Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_Id');
    }
}


