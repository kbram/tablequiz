<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAnswer extends Model
{
    protected $table = 'master_answers';

    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        
        
        'answer',
        'answer_stat',
        'question_id',
        'timestamps',
        
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\MasterlQuestion','question_id');
    }
}
