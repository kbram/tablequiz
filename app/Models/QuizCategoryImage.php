<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizCategoryImage extends Model
{
    protected $table = 'quiz_category_images';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'local_path',
        'public_path',
        'category_id',
    ];

    public function QuizCategory()
    {
        return $this->belongsTo('App\Models\QuizCategory', 'category_id');
    }

}
