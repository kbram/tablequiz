<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $guarded = [
    'id',
    ];

        /**
        * Fillable fields for a Profile.
        *
        * @var array
        */
    protected $fillable = [
    //'category_id',
    'category',
    'user_id',
    'question_type',
    'question',
    'answer',
    'time_limit',
    'timestamps',

    ];

    public function user()
    {
    return $this->belongsTo('App\Models\User', 'user_id');
    }

    // public function category()
    // {
    // return $this->belongsTo('App\Models\QuizCategory', 'category_id');
    // }
}
