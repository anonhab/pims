<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->index('created_by');
            $table->index('prison_id', 'fk_training_programs_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_programs');
    }
}

