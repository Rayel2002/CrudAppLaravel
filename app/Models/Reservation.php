<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'created_by',
        'type_Id', // Gebruik de juiste kolomnaam
        'start_time',
        'end_time',
        'place',
        'description',
        'status_Id',
        'category_Id',
    ];

    // Relatie met User (eigenaarschap)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); // Verwijs correct naar de user primary key
    }

    // Relatie met Registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'reservation_Id');
    }

    // Relatie met Categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_Id', 'category_Id'); // Verwijs correct naar de categories-tabel
    }

    // Relatie met Types
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_Id', 'type_Id'); // Gebruik de juiste type-relatie
    }

    // Relatie met Statuses
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_Id', 'status_Id'); // Verwijs correct naar de status-tabel
    }
}
