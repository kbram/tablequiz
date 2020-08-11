<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRound extends Model
{    
    protected $table = 'quiz_rounds';
   
    protected $fillable = [
        'round_name','round_slug'
    ];

    public function getImage()
    {
        return $this->hasOne('App\Models\QuizRoundImage');
    } 
}
