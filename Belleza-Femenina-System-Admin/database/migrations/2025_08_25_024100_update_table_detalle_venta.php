<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Renombrar tabla
        Schema::rename('detalle_ventas', 'detalleVenta');

        Schema::table('detalleVenta', function (Blueprint $table) {
            // Primero renombrar columnas antiguas si existen
            if (Schema::hasColumn('detalleVenta', 'venta_id')) {
                $table->renameColumn('venta_id', 'idVenta');
            }
            if (Schema::hasColumn('detalleVenta', 'producto_id')) {
                $table->renameColumn('producto_id', 'idProducto');
            }

            // Agregar nuevas columnas
            $table->unsignedBigInteger('idVariante')->after('idProducto');
            $table->decimal('subTotal', 12, 2)->after('precio_unitario');

            // Quitar timestamps
            if (Schema::hasColumn('detalleVenta', 'created_at') && Schema::hasColumn('detalleVenta', 'updated_at')) {
                $table->dropColumn(['created_at', 'updated_at']);
            }
        });

        // Agregar foreign keys nuevas
        Schema::table('detalleVenta', function (Blueprint $table) {
            $table->foreign('idVenta')
                  ->references('idVenta')
                  ->on('ventas')
                  ->onDelete('restrict');

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

    public function down(): void
    {
        // Primero eliminar FKs
        Schema::table('detalleVenta', function (Blueprint $table) {
            $table->dropForeign(['idVenta']);
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idVariante']);
        });

        Schema::table('detalleVenta', function (Blueprint $table) {
            // Eliminar columnas nuevas
            $table->dropColumn(['idVariante', 'subTotal']);

            // Renombrar columnas de vuelta
            if (Schema::hasColumn('detalleVenta', 'idVenta')) {
                $table->renameColumn('idVenta', 'venta_id');
            }
            if (Schema::hasColumn('detalleVenta', 'idProducto')) {
                $table->renameColumn('idProducto', 'producto_id');
            }

            // Volver a agregar timestamps
            $table->timestamps();
        });

        // Renombrar tabla a la original
        Schema::rename('detalleVenta', 'detalle_ventas');
    }
};
