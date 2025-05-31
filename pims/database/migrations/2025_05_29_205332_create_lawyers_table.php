<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersTable extends Migration
{
    public function up()
    {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id('lawyer_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('date_of_birth');
            $table->string('contact_info', 255);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('law_firm', 255);
            $table->string('license_number', 100)->unique();
            $table->integer('cases_handled')->default(0);
            $table->timestamps();
            $table->foreignId('prison')->nullable()->constrained('prisons')->onDelete('cascade')->onUpdate('cascade');
            $table->string('profile_image', 255)->nullable();
            $table->index('prison', 'fk_lawyer_prisons');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyers');
    }
}

