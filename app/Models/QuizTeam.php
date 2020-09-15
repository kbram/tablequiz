<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizTeam extends Model
{

    protected $table = 'quiz_teams';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'team_name',
        'quiz_id',
        
    ];

    

}
