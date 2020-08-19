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
=======
<<<<<<< HEAD
        'round_name',
        'round_slug',

    ];

    public function image()
    {
        return $this->hasMany('App\Models\QuizRoundImage');
    }
=======
>>>>>>> 022a4c9bd0c4994662656eeb61a10f369e5693f8
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
   

<<<<<<< HEAD
=======
>>>>>>> 6e272e9202afcccdffc2527bc8bbcf57542c7326
>>>>>>> 022a4c9bd0c4994662656eeb61a10f369e5693f8
}

