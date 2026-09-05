<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_no',
        'title',
        'slug',

        'description',
        'category_id',
        'listing_type',
        'price',
        'currency',
        'location',
        'address',
        'bedrooms',
        'bathrooms',
        'toilets',
        'parking_spaces',
        'property_size',
        'land_size',
        'size_unit',
        'year_built',
        'furnished',
        'featured',
        'verified',
        'status',
        'video_url',
        'floor_plan',
        'latitude',
        'longitude',
        'agent_id',
        'seo_title',
        'seo_description',
    ];


    protected $casts = [
        'featured' => 'boolean',
        'verified' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(
            PropertyCategory::class,
            'category_id'
        );
    }


    public function images()
    {
        return $this->hasMany(
            PropertyImage::class
        )->orderBy('sort_order');
    }


    public function features()
    {
        return $this->belongsToMany(
            PropertyFeature::class
        );
    }


    public function agent()
    {
        return $this->belongsTo(
            User::class,
            'agent_id'
        );
    }


    public function bookings()
    {
        return $this->hasMany(
            Booking::class
        );
    }


    public function leads()
    {
        return $this->hasMany(
            Lead::class
        );
    }


    protected static function booted()
    {
        static::creating(function ($property) {

            if (!$property->reference_no) {

                $property->reference_no =
                    'LUK-' .
                    strtoupper(
                        Str::random(8)

                    );

            }

            if (!$property->slug) {

                $property->slug =
                    Str::slug(
                        $property->title
                    );

            }

        });
    }

}
