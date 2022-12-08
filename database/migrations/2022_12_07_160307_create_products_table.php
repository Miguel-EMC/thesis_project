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
        Schema::create('products', function (Blueprint $table) {
            // ID para la tabla Appliances de la BD
            $table->id();
            // columna para la tabla Appliances de la BD
            $table->string('title', 150);
            // precio minimo del electrodomestico
            $table->float('price_min', 8, 2);
            // precio maximo del electrodomestico
            $table->float('price_max', 8, 2);
            // detalle sobre el electrodomestico
            $table->text('detail');
            // stock del electrodomestico
            $table->integer('stock');
            // estado del electrodomestico
            $table->string('state_appliance', 50);

            //columna para conocer el estado del producto
            $table->boolean('state')->default(true);
            
            // columnas que se podran aceptar como registros null en la tabla Appliances de la BD
            // metodo de envio del electrodomestico
            $table->string('delivery_method', 150)->nullable();
            // marca del electrodomestico
            $table->string('brand', 50)->nullable();

            //columna para conocer la fecha de creacion y actualizacion de los registros
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
        Schema::dropIfExists('products');
    }
};