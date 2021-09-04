<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up() {
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->longText('content');
			$table->string('section');
			$table->enum('device_type', ['web', 'mobile'])->default('web');
			$table->bigInteger('added_by_id');
			$table->bigInteger('updated_by_id');
			$table->timestamp('last_updated_at');
			$table->enum('status', ['active', 'inactive'])->default('active');
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
	public function down() {
		Schema::dropIfExists('pages');
	}
}
