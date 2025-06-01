<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('job_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('assigned_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->string('job_title', 100)->nullable();
            $table->text('job_description')->nullable();
            $table->date('assigned_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'completed', 'terminated'])->nullable();
            $table->timestamps();
            $table->index('prisoner_id', 'fk_job_assignments_prisoner');
            $table->index('assigned_by', 'fk_job_assignments_assigned_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_assignments');
    }
}

