<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterQuestion extends Model
{
    protected $table = 'master_questions';

    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        
        'question_type',
        'question',
        'time_limit',
        'timestamps',
        
    ];

    public function masterAnswer()
    {
        return $this->hasMany('App\Models\MasterAnswer');
    }
    public function masterMedia()
    {
        return $this->hasMany('App\Models\MasterQuestionMedia');
    }
}
