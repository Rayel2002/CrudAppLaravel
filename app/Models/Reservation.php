<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Reservation extends Model
{
    protected $fillable = [
        'reservation_type',
        'start_time',
        'end_time',
        'place',
        'description',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'reservation_Id');
    }
}
