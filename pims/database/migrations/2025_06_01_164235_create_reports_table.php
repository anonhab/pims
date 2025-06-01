<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generated_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            $table->text('content')->nullable();
            $table->text('report_type');
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('generated_by', 'fk_reports_generated_by');
            $table->index('prison_id', 'fk_reports_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}

