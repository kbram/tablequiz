<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    
    protected $table = 'participants';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'from',
        'to',
        'cost',
    ];
}
