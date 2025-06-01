<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->text('request_type')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'transferred'])->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->text('request_details')->nullable();
            $table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->text('evaluation')->nullable();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->index('prisoner_id', 'idx_prisoner_id');
            $table->index('approved_by', 'fk_requests_approved_by');
            $table->index('lawyer_id', 'fk_requests_lawyer');
            $table->index('user_id', 'fk_requests_user');
            $table->index('prison_id', 'fk_prison_id_for_request');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}

