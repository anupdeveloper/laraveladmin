<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_cards', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('brand');
            $table->string('exp_month');
            $table->string('exp_year');
            $table->string('last4');
            $table->foreignId('organization_id')->constrained();
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
        Schema::dropIfExists('saved_cards');
    }
}
