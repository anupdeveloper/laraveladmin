<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobUpdateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_update_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('transaction_date');
            $table->dateTime('advert_start_date');
            $table->dateTime('advert_end_date');
            $table->tinyInteger('selected_days')->nullable();
            $table->foreignId('job_id')->constrained();
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
        Schema::dropIfExists('job_update_logs');
    }
}
