<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $table = 'user_payments';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'street',
        'city',
        'country',
        'card_number',
        'exp_month',
        'exp_year',
        'cvv',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
