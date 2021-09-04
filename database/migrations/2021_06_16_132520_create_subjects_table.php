<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->unsigned();
            $table->integer('course_id')->unsigned();
            //$table->foreign('school_id')->references('id')->on('schools');
            $table->string('name')->unique();
            $table->text('desc')->nullable();
            //$table->double('price',10,2);
            $table->string('duration')->nullable();
            $table->tinyInteger('status')->default(0);
              $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('subjects');
    }
}
