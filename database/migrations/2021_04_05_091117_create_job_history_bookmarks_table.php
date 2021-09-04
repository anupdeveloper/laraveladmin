<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoryBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_history_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_history_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('is_bookmarked')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('job_history_bookmarks');
    }
}
