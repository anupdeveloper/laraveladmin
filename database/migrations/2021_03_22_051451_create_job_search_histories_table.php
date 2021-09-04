<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSearchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_search_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('keywords')->nullable();
            $table->string('sorted_by')->nullable();
            $table->string('location')->nullable();
            $table->string('industry')->nullable();
            $table->string('distance')->nullable();
            $table->string('posted_within_days')->nullable();
            $table->string('job_type')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_search_histories');
    }
}
