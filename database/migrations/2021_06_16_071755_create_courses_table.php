<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->unsigned();
            //$table->foreign('school_id')->references('id')->on('schools');
            $table->string('name');
            $table->string('course_code');
            $table->string('join_code')->unique();
            $table->datetime('course_start_date');
            $table->double('price',10,2);
            $table->string('subject')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->softDeletes(); // <-- This will add a deleted_at field
            $table->timestamps();
            $table->unique(['name','school_id', 'course_code','created_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
