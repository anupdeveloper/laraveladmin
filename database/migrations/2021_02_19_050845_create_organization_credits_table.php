<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_credits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total_paid_credits')->default(0);
            $table->bigInteger('trial_credits')->default(0);
            $table->tinyInteger('status')->comment('1 => Active , 0 => Incative')->default(1);
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
        Schema::dropIfExists('organization_credits');
    }
}
