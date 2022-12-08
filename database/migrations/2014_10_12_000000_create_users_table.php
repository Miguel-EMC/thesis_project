<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // ID para la tabla User de la BDD
            $table->id();

            // columnas para la tabla User de la BDD 
            $table->string('username', 50);
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->double('personal_phone', 10)->nullable();
            $table->double('home_phone', 7)->nullable();
            $table->string('address', 50)->nullable();
            $table->boolean('state')->default(true);

            // columnas que seran unicas para la tabla User de la BD
            $table->string('email')->unique();

            // columna que acepta registros null en la tabla User de la BD
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // columnas especiales para la tabla User de BD
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