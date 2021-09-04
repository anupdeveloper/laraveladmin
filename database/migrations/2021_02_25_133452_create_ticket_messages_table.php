<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->text('message_text');
            $table->string('attachment_file')->nullable();            
            $table->foreignId('ticket_id')->constrained();
            $table->foreignId('recruiter_id')->nullable()->constrained()->default(null);
            $table->foreignId('admin_id')->nullable()->constrained()->default(null);
            $table->enum('sent_by',['admin','recruiter']);
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
        Schema::dropIfExists('ticket_messages');
    }
}
