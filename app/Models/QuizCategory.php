<?php

namespace App\Model;

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


    
}
