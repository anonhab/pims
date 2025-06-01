<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisonersTable extends Migration
{
    public function up()
    {
        Schema::create('prisoners', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->text('crime_committed')->nullable();
            $table->enum('status', ['active', 'released', 'transferred'])->nullable();
            $table->date('time_serve_start')->nullable();
            $table->text('time_serve_end')->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_relation', 50)->nullable();
            $table->string('emergency_contact_number', 20)->nullable();
            $table->text('inmate_image')->nullable();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('release_date')->nullable();
            $table->timestamps();
            $table->index('room_id', 'fk_room');
            $table->index('prison_id', 'fk_prisoners_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prisoners');
    }
}

