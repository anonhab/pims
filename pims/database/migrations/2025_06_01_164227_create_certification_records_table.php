<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('certification_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('issued_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->enum('certification_type', ['job_completion', 'training_program_completion'])->nullable();
            $table->text('certification_details')->nullable();
            $table->datetime('issued_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', ['issued', 'revoked'])->nullable();
            $table->timestamps();
            $table->index('prisoner_id', 'fk_certification_records_prisoner');
            $table->index('issued_by', 'fk_certification_records_issued_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certification_records');
    }
}

