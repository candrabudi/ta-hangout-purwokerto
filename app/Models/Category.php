<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];


    public function hangouts()
    {
        return $this->belongsToMany(Hangout::class, 'category_hangout');
    }
}
