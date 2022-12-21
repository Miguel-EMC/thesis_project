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
            //Columna para el mensaje
            $table->text('message');

            //un mensaje pertenece a un producto y un producto puede tener muchos mensajes
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            // Un usuario puede recibir muchos mensajes y un mensaje puede ser enviado a muchos usuarios
            $table->unsignedBigInteger('recipient_id');
            $table->foreign('recipient_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            // Un usuario puede enviar muchos mensajes y un mensaje puede ser enviado por muchos usuarios
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            //columna para conocer la fecha de creacion y actualizacion
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
