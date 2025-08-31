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
        // Renombrar tabla
        Schema::rename('gastos_operativos', 'gastosOperativos');

        // Renombrar columna
        Schema::table('gastosOperativos', function (Blueprint $table) {
            $table->renameColumn('metodo_pago', 'metodoPago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir nombre de la columna
        Schema::table('gastosOperativos', function (Blueprint $table) {
            $table->renameColumn('metodoPago', 'metodo_pago');
        });

        // Revertir nombre de tabla
        Schema::rename('gastosOperativos', 'gastos_operativos');
    }
};
