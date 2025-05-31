<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewVisitingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('new_visiting_requests', function (Blueprint $table) {
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
            $table->time('requested_time');
            $table->text('note')->nullable();
            $table->index('prison_id');
            $table->index('approved_by', 'fk_approved_by');
            $table->index('visitor_id', 'fk_visitor_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_visiting_requests');
    }
}

