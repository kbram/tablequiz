<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    protected $table = 'quiz_categories';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
    public function quizCategoryImages()
    {
        return $this->hasOne('App\Models\QuizCategoryImage','category_id');
    }


    
}
