<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangoutRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'hangout_id',
        'rating',
        'ip_address',
    ];
}
