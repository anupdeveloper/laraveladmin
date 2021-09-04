<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('subject_id')->unsigned()->nullable();
            $table->string('question_type');
            //$table->foreign('school_id')->references('id')->on('schools');
            $table->string('name')->unique();
            $table->text('desc');
            //$table->double('price',10,2);
            $table->integer('duration')->nullable();
            $table->string('starts_on')->nullable();
            $table->string('ends_on')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            //$table->foreign('question_id')->references('id')->on('questions');
            $table->softDeletes(); // <-- This will add a deleted_at field
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
        Schema::dropIfExists('questions');
    }
}
