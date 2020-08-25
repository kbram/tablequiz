<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterQuestionMedia extends Model
{
    protected $table = 'master_question_media';

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
    public function masterQuestion()
    {
        return $this->belongsTo('App\Models\MasterQuestion', 'question_id');
    }
}
