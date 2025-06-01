<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('medications')->nullable();
            $table->datetime('report_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreignId('appointment_id')->nullable()->constrained('medical_appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('follow_up_date')->nullable();
            $table->text('notes')->nullable();
            $table->text('follow_up')->nullable();
            $table->index('prisoner_id', 'fk_medical_reports_prisoner');
            $table->index('doctor_id', 'fk_medical_reports_doctor');
            $table->index('appointment_id', 'fk_appointment');
            $table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_reports');
    }
}

