<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('training_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('training_id')->nullable()->constrained('training_programs')->onDelete('cascade');
            $table->foreignId('assigned_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->date('assigned_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['in_progress', 'completed'])->nullable();
            $table->timestamps();
            $table->index('prisoner_id');
            $table->index('training_id');
            $table->index('assigned_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_assignments');
    }
}

