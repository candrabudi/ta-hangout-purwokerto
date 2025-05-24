<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hangout extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'slug',
        'address',
        'description',
        'status',
        'google_maps_url',
        'longtitud',
        'latitud',
        'thumbnail',
    ];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function ratings()
    {
        return $this->hasMany(HangoutRating::class);
    }

    public function images()
    {
        return $this->hasMany(HangoutImage::class);
    }

    public function visitorRatings()
    {
        return $this->hasMany(\App\Models\VisitorInteraction::class)
            ->where('interaction_type', 'rating')
            ->whereNotNull('rating_value');
    }

}
