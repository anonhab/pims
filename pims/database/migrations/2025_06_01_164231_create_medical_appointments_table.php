<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->datetime('appointment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->nullable();
            $table->foreignId('created_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->index('prisoner_id', 'fk_medical_appointments_prisoner');
            $table->index('doctor_id', 'fk_medical_appointments_doctor');
            $table->index('created_by', 'fk_medical_appointments_created_by');
            $table->index('prison_id', 'fk_prisonformedical');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_appointments');
    }
}

