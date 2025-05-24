<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visitor extends Model
{
    public $incrementing = false; // UUID primary key
    protected $keyType = 'string';
    protected $fillable = ['device_info'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function interactions()
    {
        return $this->hasMany(VisitorInteraction::class);
    }
}
