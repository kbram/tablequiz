<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
protected $table = 'questions';

protected $guarded = [
'id',
];

/**
* Fillable fields for a Profile.
*
* @var array
*/
protected $fillable = [
    
'user_id',
'question_type',
'question',
'round_id',
'time_limit',
'timestamps',

];

public function user()
{
return $this->belongsTo('App\Models\User', 'user_id');
}

public function category()
{
return $this->belongsTo('App\Models\QuizCategory', 'category_id');
}
public function rounds()
{
return $this->belongsTo('App\Models\QuizRound', 'round_id');
}

}