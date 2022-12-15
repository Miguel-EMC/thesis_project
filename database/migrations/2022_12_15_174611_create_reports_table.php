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
        Schema::create('reports', function (Blueprint $table) {
            //ID para la tabla reports de la BDD
            $table->id();
            //columna para la tabla reports de la BDD
            $table->string('title');
            $table->text('description');
            //Columna para el estado del reporte            
            $table->boolean('state')->default(true);

            //Relación
            //un reporte pertenece a un usuario y un usuario puede tener muchos reportes
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();

            //un reporte pertenece a un producto y un producto puede tener muchos reportes
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};