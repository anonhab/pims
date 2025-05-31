<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 20);
            $table->integer('capacity')->nullable();
            $table->enum('type', ['cell', 'medical', 'security', 'training', 'visitor', 'isolation'])->nullable();
            $table->enum('status', ['available', 'occupied', 'under_maintenance'])->nullable();
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('prison_id', 'fk_prison_rooms');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}

