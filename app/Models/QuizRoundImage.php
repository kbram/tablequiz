<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRoundImage extends Model
{   
    protected $table = 'quiz_round_images';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'local_path',
        'public_path',
        'thumb_path',
        'round_id',
        'txt_image'
        
    ];

    public function round()
    {
        return $this->belongsTo('App\Models\QuizRound', 'round_id');
    }
}
