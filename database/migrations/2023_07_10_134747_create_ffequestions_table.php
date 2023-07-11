<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFfequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ffequestions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate();
            $table->longText('question_text');
            $table->text('compulsory_line1')->nullable();
            $table->text('compulsory_line2')->nullable();
            $table->text('optional_line1')->nullable();
            $table->text('optional_line2')->nullable();
            $table->text('optional_line3')->nullable();
            $table->unsignedTinyInteger('error_line')->nullable();
            $table->text('correct_command')->nullable();
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
        Schema::dropIfExists('ffequestions');
    }
}