<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerPrisonerAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('lawyer_prisoner_assignment', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->foreignId('prisoner_id')->constrained()->onDelete('cascade');
            $table->date('assignment_date');
            $table->foreignId('assigned_by')->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->foreignId('lawyer_id')->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('prisoner_id');
            $table->index('assigned_by');
            $table->index('lawyer_id', 'fk_lawyer_prisoner');
            $table->index('prison_id', 'fk_lawyer_assignment');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyer_prisoner_assignment');
    }
}

