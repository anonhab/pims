<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->text('action')->nullable();
            $table->enum('entity', ['account', 'prison', 'prisoner', 'report', 'backup', 'request', 'medical_report', 'certification_record'])->nullable();
            $table->timestamps();
            $table->index('account_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_logs');
    }
}

