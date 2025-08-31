<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalleCompras', function (Blueprint $table) {
           
            // Quitar foráneas viejas si existen
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idVarianteProducto']);
            $table->dropForeign(['idCompra']);

            // Crear relaciones con las llaves actuales
            $table->foreign('idProducto')
                ->references('idProducto')
                ->on('productos')
                ->onDelete('restrict');

            $table->foreign('idVarianteProducto')
                ->references('idVariante')
                ->on('variantesProducto')
                ->onDelete('restrict');

            $table->foreign('idCompra')
                ->references('idCompra')
                ->on('compras')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('detalleCompras', function (Blueprint $table) {
           

            // Quitar foráneas nuevas
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idVarianteProducto']);
            $table->dropForeign(['idCompra']);

            // Restaurar relaciones anteriores (PK antiguas)
            $table->foreign('idProducto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('restrict');

            $table->foreign('idVarianteProducto')
                ->references('id_variantes')
                ->on('variantes_productos')
                ->onDelete('restrict');

            $table->foreign('idCompra')
                ->references('idCompra')
                ->on('compras')
                ->onDelete('restrict');
        });
    }
};
