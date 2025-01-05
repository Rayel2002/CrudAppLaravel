<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    protected $fillable = ['reservation_type'];

    // Relatie met Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'reservation_type_Id');
    }
}
