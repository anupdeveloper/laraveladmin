<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up() {
		Schema::create('permissions', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->string('module_name');
			$table->string('module_slug');
			$table->longtext('description')->nullable();
			$table->integer('status')->comment('1 => Active , 0 => Incative')->default(1);
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
		Schema::dropIfExists('permissions');
	}
}
