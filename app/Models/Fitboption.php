<?php

namespace App\Models;

use App\Models\Fitbquestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitboption extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question(){
        return $this->belongsTo(Fitbquestion::class, 'fitbquestion_id');
    }
}
