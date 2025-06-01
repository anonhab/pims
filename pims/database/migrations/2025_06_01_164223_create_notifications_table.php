<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('recipient_id')->nullable();
            $table->enum('recipient_role', ['admin', 'doctor', 'officer', 'lawyer', 'prisoner', 'visitor', 'inspector', 'commissioner', 'security', 'system_admin', 'training_officer', 'discipline_officer']);
            $table->integer('role_id')->default(0);
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('related_table', 50)->nullable();
            $table->integer('related_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(0);
            $table->index('prison_id', 'fk_notifications_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

