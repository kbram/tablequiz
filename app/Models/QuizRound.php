<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRound extends Model
{
    protected $table = 'quiz_rounds';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'round_name',
        'round_slug',

    ];

    public function image()
    {
        return $this->hasMany('App\Models\QuizRoundImage');
    }
}
