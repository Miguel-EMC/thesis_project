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
        Schema::create('messages', function (Blueprint $table) {
            //ID para la tabla messages de la BDD
            $table->id();
            //columna para la tabla messages de la BDD
            $table->text('message');
            $table->unsignedBigInteger('from');
            $table->foreign('from')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('to')->unsigned();
            
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
        Schema::dropIfExists('messages');
    }
};