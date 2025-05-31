<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('relationship', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('identification_number', 100)->nullable()->unique();
            $table->text('email');
            $table->string('password', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}

