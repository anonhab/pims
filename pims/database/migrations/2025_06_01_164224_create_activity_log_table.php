<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type', 100)->comment('Type of activity (e.g., create_backup, assign_job, schedule_appointment)');
            $table->string('table_name', 50)->comment('Name of the table affected (e.g., backups, job_assignments)');
            $table->integer('record_id')->comment('ID of the affected record in the respective table');
            $table->foreignId('user_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('activity_details')->nullable()->comment('Additional details about the activity');
            $table->timestamps();
            $table->index('user_id');
            $table->index('prisoner_id');
            $table->index('lawyer_id');
            $table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_log');
    }
}

