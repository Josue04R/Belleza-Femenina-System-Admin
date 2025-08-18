<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalleCompras', function (Blueprint $table) {
            $table->id('idDetalleCompra');
            $table->integer('idProducto');
            $table->integer('idVarianteProducto');
            $table->integer('cantidad');
            $table->double('subtotal');

            $table->foreign('idProducto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('restrict');

            $table->foreign('idVarianteProducto')
                ->references('id_variantes')
                ->on('variantes_producto')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleCompras');
    }
};
