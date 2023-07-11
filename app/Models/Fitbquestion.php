<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitbquestion extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fitbresults()
    {
        return $this->belongsToMany(Fitbresult::class, 'fitbquestion_fitbresult')->withPivot('answer', 'points');
    }

    public function fitboptions()
    {
        return $this->hasMany(Fitboption::class);
    }
}