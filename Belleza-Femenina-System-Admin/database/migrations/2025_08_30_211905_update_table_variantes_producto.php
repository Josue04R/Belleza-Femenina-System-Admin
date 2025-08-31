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
        // Renombrar la tabla
        Schema::rename('variantes_productos', 'variantesProducto');

        // Renombrar columnas
        Schema::table('variantesProducto', function (Blueprint $table) {
            // Primero quitamos las foreign keys viejas
            $table->dropForeign(['id_producto']);
            $table->dropForeign(['id_talla']);

            // Renombrar columnas
            $table->renameColumn('id_variantes', 'idVariante');
            $table->renameColumn('id_producto', 'idProducto');
            $table->renameColumn('id_talla', 'idTalla');
        });

        // Volvemos a crear las foreign keys con los nuevos nombres
        Schema::table('variantesProducto', function (Blueprint $table) {
            $table->foreign('idProducto')
                ->references('idProducto')
                ->on('productos')
                ->onDelete('cascade');

            $table->foreign('idTalla')
                ->references('idTalla')
                ->on('tallas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir foreign keys nuevas
        Schema::table('variantesProducto', function (Blueprint $table) {
            $table->dropForeign(['idProducto']);
            $table->dropForeign(['idTalla']);

            // Restaurar nombres originales
            $table->renameColumn('idVariante', 'id_variantes');
            $table->renameColumn('idProducto', 'id_producto');
            $table->renameColumn('idTalla', 'id_talla');
        });

        // Restaurar nombre de tabla
        Schema::rename('variantesProducto', 'variantes_productos');

        // Restaurar foreign keys originales
        Schema::table('variantes_productos', function (Blueprint $table) {
            $table->foreign('id_producto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('cascade');

            $table->foreign('id_talla')
                ->references('id_talla')
                ->on('tallas')
                ->onDelete('cascade');
        });
    }
};

