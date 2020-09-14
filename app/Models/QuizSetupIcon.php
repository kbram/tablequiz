<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSetupIcon extends Model
{
    protected $table="quiz_setup_icons";

    protected $guarded=[
        'id',
    ];

    protected $fillable = [
        'quiz_id',
        'public_path',
        'local_path',
        'quiz_link',
        'thumb_path',
    ];

    public function quiz()
     {      
          return $this->belongsTo('App\Models\Quiz', 'quiz_id');
     }
}
