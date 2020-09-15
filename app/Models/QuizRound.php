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
   
     public function getImage()
    {
        return $this->hasOne('App\Models\QuizRoundImage');
    } 


}

