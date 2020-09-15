<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalQuestion extends Model
{
    protected $table = 'global_questions';

    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        
        'category_id',
        'question_type',
        'question',
        'time_limit',
        'timestamps',
        
    ];

   
    public function answer()
    {
        return $this->hasMany('App\Models\GlobalAnswer');
    }
    public function media()
    {
        return $this->hasMany('App\Models\GlobalQuestionMedia');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\QuizCategory', 'category_id');
    }


}
