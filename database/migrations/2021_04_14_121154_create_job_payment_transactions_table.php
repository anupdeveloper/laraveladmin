<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('txn_id');
            $table->integer('amount');
            $table->integer('sub_total');
            $table->integer('vat');
            $table->integer('vat_percentage');
            $table->string('status');
            $table->string('description');
            $table->string('invoice');
            $table->text('request');
            $table->text('response');
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId('job_id')->constrained();
            $table->foreignId('organization_id')->constrained();
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
        Schema::dropIfExists('job_payment_transactions');
    }
}
