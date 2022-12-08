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
        Schema::create('subscriptions', function (Blueprint $table) {
            //ID para la tabla subscriptions de la BDD
            $table->id();
            //columna para la tabla subscriptions de la BDD
            $table->string('title');
            $table->string('tipe_payment');
            $table->float('price', 8, 2);
            //Columna para el estado del reporte
            $table->boolean('state')->default(true);

            //Relación
            // una suscripcion pertenece a un usuario y un usuario puede tener muchas suscripciones
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // una suscripcion pertenece a un producto y un producto puede tener muchas suscripciones
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('subscriptions');
    }
};