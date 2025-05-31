<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type', 255)->nullable();
            $table->bigInteger('device_id')->nullable();
            $table->string('event', 255);
            $table->string('auditable_type', 255);
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 1023)->nullable();
            $table->string('tags', 255)->nullable();
            $table->timestamps();
            $table->integer('auditable_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audits');
    }
}

