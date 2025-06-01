<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupsTable extends Migration
{
    public function up()
    {
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initiated_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->datetime('backup_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('backup_status', ['in_progress', 'completed', 'failed'])->nullable();
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('initiated_by', 'fk_backups_user');
            $table->index('prison_id', 'fk_backups_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('backups');
    }
}

