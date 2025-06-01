<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('lawyer_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            $table->datetime('appointment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('prisoner_id', 'fk_lawyer_appointments_prisoner');
            $table->index('lawyer_id', 'fk_lawyer_appointments_lawyer');
            $table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyer_appointments');
    }
}

