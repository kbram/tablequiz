<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamAnswer extends Model
{
    protected $table = 'team_answers';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'team_name',
        'status',
        'status',
        'answer',
        'answer_id',
        'round_id',


        'quiz_id',
        'question_id'
        
    ];

}
