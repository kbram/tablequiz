<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionMedia extends Model
{
    protected $table = 'question_media';

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
    public function Question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
