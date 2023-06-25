<?php

use App\Models\Fitbquestion;
use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitboptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitboptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fitbquestion::class)->constrained()->cascadeOnUpdate();
            $table->longText('option_text');
            $table->integer('points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fitboptions');
    }
}
