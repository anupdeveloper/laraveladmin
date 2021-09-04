<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_ref_number');
            $table->string('job_title');
            $table->text('job_description');
            $table->enum('job_type',['full_time','contract_basis','part_time','graduate','public_sector','work_from_home']);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_suspended')->default(0);
            $table->tinyInteger('is_payment_received')->default(0);
            $table->string('company_logo')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('state')->nullable();
            $table->string('country');
            $table->double('latitude', 11, 7)->nullable();
            $table->double('longitude', 11, 7)->nullable();
            $table->string('job_url');
            $table->foreignId('job_industry_id')->constrained();
            $table->string('job_function')->nullable();
            // $table->foreignId('job_location_id')->constrained();
            $table->double('package_range_from', 15, 2)->nullable();
            $table->double('package_range_to', 15, 2)->nullable();
            $table->enum('salary_currency', ['pounds', 'dollars']);
            $table->enum('salary_type', ['annually', 'hourly'])->nullable();
            $table->float('experience_range_min')->nullable();
            $table->enum('employment_eligibility', ['visa_considered', 'sponsorship_offered'])->default('visa_considered');
            $table->enum('status', ['open','close']);
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->string('created_by')->nullable();
            $table->enum('advert_days',[30,60,90])->nullable();
            $table->dateTime('expiring_at')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
