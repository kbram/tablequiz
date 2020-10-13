<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    

    protected $table = 'payment_details';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'quiz_id'
        
    ];

}
