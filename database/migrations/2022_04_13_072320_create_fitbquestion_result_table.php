<?php

use App\Models\Fitbquestion;
use App\Models\Fitbresult;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitbquestionResultTable extends Migration
{
    public function up()
    {
        Schema::create('fitbquestion_fitbresult', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fitbresult::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Fitbquestion::class)->constrained()->cascadeOnDelete();
            $table->string('answer')->nullable();
            $table->integer('points')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fitbquestion_fitbresult');
    }
}