<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $table = 'answers';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'answer',
        'status',
        'question_id',

        
    ];
}
