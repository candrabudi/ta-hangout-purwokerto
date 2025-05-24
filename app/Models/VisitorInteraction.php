<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorInteraction extends Model
{
    protected $fillable = ['visitor_id', 'hangout_id', 'interaction_type', 'rating_value'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function hangout()
    {
        return $this->belongsTo(Hangout::class);
    }
}
