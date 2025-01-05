<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_Id', 'reservation_Id', 'registrationStatus', 'registrationDate',
    ];

    // Relatie met User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_Id');
    }

    // Relatie met Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_Id');
    }
}
