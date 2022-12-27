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
        Schema::create('subscriptions', function (Blueprint $table) {
            //ID para la tabla subscriptions de la BDD
            $table->id();
            
            //Estado de la suscripción
            $table->string('status');

            //Método de pago
            $table->string('payment_method');
            //Fecha de inicio de la suscripción
            $table->date('start_date');
            //Fecha de fin de la suscripción
            $table->date('end_date');

            //Precio de la suscripción
            $table->unsignedDecimal('price', 8, 2);

            //Relación con la tabla users 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            //Relación con la tabla products
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        
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