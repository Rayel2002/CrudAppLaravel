<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status'];

    // Relatie met Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'status_Id');
    }
}
