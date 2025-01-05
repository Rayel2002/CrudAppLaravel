<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'role_Id', 'name', 'email', 'password', 'email_verified_at', 'login_days', 'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relatie met Roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_Id');
    }

    // Relatie met Registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'user_Id');
    }

    // Relatie met Reservations (eigenaarschap)
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'created_by');
    }
}
