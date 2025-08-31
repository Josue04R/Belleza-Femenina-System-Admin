<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalleVenta', function (Blueprint $table) {
            // Renombrar columna precio_unitario → precioUnitario
            if (Schema::hasColumn('detalleVenta', 'precio_unitario')) {
                $table->renameColumn('precio_unitario', 'precioUnitario');
            }

            // Quitar foráneas viejas si existen
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idVariante']);

            // Crear relaciones con las llaves actuales
            $table->foreign('idProducto')
                ->references('idProducto')
                ->on('productos')
                ->onDelete('restrict');

            $table->foreign('idVariante')
                ->references('idVariante')
                ->on('variantesProducto')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('detalleVenta', function (Blueprint $table) {
            // Revertir nombre de la columna
            if (Schema::hasColumn('detalleVenta', 'precioUnitario')) {
                $table->renameColumn('precioUnitario', 'precio_unitario');
            }

            // Quitar foráneas nuevas
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idVariante']);

            // Restaurar con los nombres anteriores
            $table->foreign('idProducto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('restrict');

            $table->foreign('idVariante')
                ->references('id_variantes')
                ->on('variantes_productos')
                ->onDelete('restrict');
        });
    }
};