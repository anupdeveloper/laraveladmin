<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_email_verified')->default(0);
            $table->string('phone_number')->nullable();
            $table->tinyInteger('is_job_alert_enabled')->default(0);
            $table->ipAddress('ip_address');
            $table->rememberToken();
            $table->enum('login_with',['email','facebook','google']);
            $table->enum('signup_via',['mobile','web'])->default('mobile');
            $table->tinyInteger('is_user_locked')->default(0);
            $table->timestamp('user_locked_at')->nullable();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('resume')->nullable();
            $table->enum('role_id', [3, 4]);
            $table->tinyInteger('online_status')->default(0);
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
        Schema::dropIfExists('users');
    }
}
