<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name'];

    // Relatie met Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'category_Id');
    }
}

