<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalQuestionMedia extends Model
{
    protected $table = 'global_question_medias';

    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'question_id',
        'media_link',
        'media_type',
        'local_path',
        'public_path',
        
    
       
    ];
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
