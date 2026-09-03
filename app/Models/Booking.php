<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'user_id',
        'name',
        'email',
        'phone',
        'inspection_date',
        'inspection_time',
        'message',
        'status',
    ];


    protected $casts = [
        'inspection_date' => 'date',
    ];


    public function property()
    {
        return $this->belongsTo(
            Property::class
        );
    }


    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}
