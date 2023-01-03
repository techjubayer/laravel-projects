<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string('idCode', 10)->unique();
            $table->string('phone', 15)->unique();
            $table->string('email', 40)->nullable();
            $table->string('name', 30)->nullable();
            $table->integer('isActive', false, true)->default(1);
            $table->string('password', 150);
            $table->string('shopName', 30)->nullable();
            $table->string('market', 30)->nullable();
            $table->string('pin', 8)->nullable();
            $table->string('adress', 200)->nullable();
            $table->string('state', 30)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('token', 150)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
