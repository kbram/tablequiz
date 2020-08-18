<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $guarded = [
<<<<<<< HEAD
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

=======
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
        'round_id',
        'time_limit',
        'timestamps',
        
>>>>>>> 6e272e9202afcccdffc2527bc8bbcf57542c7326
    ];

    public function user()
    {
<<<<<<< HEAD
    return $this->belongsTo('App\Models\User', 'user_id');
    }

    // public function category()
    // {
    // return $this->belongsTo('App\Models\QuizCategory', 'category_id');
    // }
=======
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\QuizCategory', 'category_id');
    }
    public function rounds()
    {
        return $this->belongsTo('App\Models\QuizRound', 'round_id');
    }

>>>>>>> 6e272e9202afcccdffc2527bc8bbcf57542c7326
}
