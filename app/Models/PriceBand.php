<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceBand extends Model
{
    protected $table = 'price_bands';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'from',
        'to',
        'band_type',
        'cost',
    ];
}
