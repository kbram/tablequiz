<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRoundImage extends Model
{
    protected $fillable = [
        'name', 'url','round_id',
    ];

    public function round()
    {
        return $this->belongsTo('App\Models\QuizRound');
    }
    
}
