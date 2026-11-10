<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'whatsapp',
        'address',
        'city',
        'state',
        'country',
        'customer_type',
        'status',
        'notes',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
