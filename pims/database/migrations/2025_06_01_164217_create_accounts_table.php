<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->text('user_image')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            $table->index('prison_id', 'fk_accounts_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}

