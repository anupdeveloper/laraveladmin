<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_option', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id')->unsigned();
            $table->integer('option_key');
            $table->string('option_value');
            $table->tinyInteger('is_correct')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['question_id','option_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_option');
    }
}
