<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Registration extends Model
{
    protected $fillable = [
        'user_Id',
        'reservation_Id',
        'registrationStatus',
        'registrationDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_Id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_Id');
    }
}
