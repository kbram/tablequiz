<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRound extends Model
{
    protected $table = 'quiz_rounds';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
<<<<<<< HEAD
        'round_name',
        'round_slug',

    ];

    public function image()
    {
        return $this->hasMany('App\Models\QuizRoundImage');
    }
=======
        'quiz_id',
        'round_name',
        'round_slug',
    ];

    public function quizzes()
    {
        return $this->belongsTo('App\Models\Quiz','quiz_id');
    }
     public function questions()
     {
         return $this->hasMany('App\Models\Question');
     }
   

>>>>>>> 6e272e9202afcccdffc2527bc8bbcf57542c7326
}

