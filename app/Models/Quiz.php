<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'quiz__name',
        'quiz_password',
        'quiz_link',
        'no_of_participants',
        'no_suggested_questions'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function rounds()
    {
        return $this->hasMany('App\Models\QuizRound');
    }
    public function questions(){

    return $this->hasManyThrough('App\Models\Question','App\Models\QuizRound','quiz_id','round_id');
    }

    public function icon(){
        return $this->hasOne('App\Models\QuizSetupIcon');
    }
   

}
