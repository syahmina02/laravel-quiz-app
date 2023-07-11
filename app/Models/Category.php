<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Fitbquestion; // Import the Fitbquestion model

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function categoryQuestions()
    {
        return $this->hasMany(Question::class);
    }


    public function categoryFitbQuestions()
    {
        return $this->hasMany(Fitbquestion::class, 'category_id');
    }
}
