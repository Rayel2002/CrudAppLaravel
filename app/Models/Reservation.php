<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'created_by', 'reservation_type_Id', 'start_time', 'end_time', 'place', 'description', 'status_Id', 'category_Id',
    ];

    // Relatie met User (eigenaarschap)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relatie met Registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'reservation_Id');
    }

    // Relatie met Categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_Id');
    }

    // Relatie met ReservationTypes
    public function reservationType()
    {
        return $this->belongsTo(ReservationType::class, 'reservation_type_Id');
    }

    // Relatie met Statuses
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_Id');
    }
}
