<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicePrisonerAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('police_prisoner_assignment', function (Blueprint $table) {
            $table->bigIncrements('assignment_id');
            $table->foreignId('officer_id')->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->foreignId('prisoner_id')->constrained()->onDelete('cascade');
            $table->foreignId('prison_id')->constrained()->onDelete('cascade');
            $table->date('assignment_date');
            $table->foreignId('assigned_by')->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->timestamps();
            $table->index('officer_id');
            $table->index('prisoner_id');
            $table->index('assigned_by');
            $table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('police_prisoner_assignment');
    }
}

