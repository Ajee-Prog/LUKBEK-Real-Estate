<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'agent_id',
        'name',
        'email',
        'phone',
        'source',
        'status',
        'notes',
    ];


    public function property()
    {
        return $this->belongsTo(
            Property::class
        );
    }


    public function agent()
    {
        return $this->belongsTo(
            User::class,
            'agent_id'
        );
    }
}
