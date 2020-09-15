<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamQuiz extends Model
{

    protected $table = 'team_quizzes';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'team_name',
        'quiz_id',
        
    ];

    

}
