<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitbquestionCount extends Model
{
    protected $fillable = [
        'category_id',
        'count',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}