<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('visiting_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('requested_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->timestamps();
            $table->string('prisoner_firstname', 255)->nullable();
            $table->string('prisoner_middlename', 255)->nullable();
            $table->string('prisoner_lastname', 255)->nullable();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('approved_by');
            $table->index('prison_id', 'idx_prison_id');
            $table->index('visitor_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visiting_requests');
    }
}

