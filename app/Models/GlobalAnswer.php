<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalAnswer extends Model
{
    protected $table = 'global_answers';

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
        return $this->belongsTo('App\Models\GlobalQuestion','question_id');
    }


}
