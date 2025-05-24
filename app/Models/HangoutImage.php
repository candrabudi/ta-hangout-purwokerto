<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangoutImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hangout_id',
        'image_path',
    ];
}
