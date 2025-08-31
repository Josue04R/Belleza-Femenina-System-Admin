<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        // Renombrar tabla
        Schema::rename('detalle_pedidos', 'detallePedidos');

        // Ajustar columna y crear FK
        Schema::table('detallePedidos', function (Blueprint $table) {
            if (Schema::hasColumn('detallePedidos', 'id_variantes')) {
                $table->renameColumn('id_variantes', 'idVariante');
            }

            // Crear la foreign key con el nombre correcto
            $table->foreign('idVariante')
                ->references('idVariante')
                ->on('variantesProducto')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Eliminar FK antes de renombrar columna
        Schema::table('detallePedidos', function (Blueprint $table) {
            $table->dropForeign(['idVariante']);

            if (Schema::hasColumn('detallePedidos', 'idVariante')) {
                $table->renameColumn('idVariante', 'id_variantes');
            }
        });

        // Renombrar tabla de vuelta
        Schema::rename('detallePedidos', 'detalle_pedidos');

        // Restaurar foreign key original
        Schema::table('detalle_pedidos', function (Blueprint $table) {
            $table->foreign('id_variantes')
                  ->references('id_variantes')
                  ->on('variantes_productos')
                  ->onDelete('set null');
        });
    }
};
