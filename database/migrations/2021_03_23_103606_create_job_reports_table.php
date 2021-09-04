<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('job_id')->constrained();
            $table->string('reported_by')->nullable();
            $table->string('job_ref_number')->nullable();
            $table->string('issue_description');
            $table->string('cookie_value')->nullable();
            $table->string('email_subject')->nullable();
            $table->string('email_content')->nullable();
            $table->string('email_sent')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('job_reports');
    }
}
