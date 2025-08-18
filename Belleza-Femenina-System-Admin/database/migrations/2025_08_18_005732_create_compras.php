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
        Schema::create('compras', function (Blueprint $table) {
            $table->id('idCompra');
            $table->integer('idEmpleado');
            $table->double('total');
            $table->date('fecha');

            $table->foreign('idEmpleado')
                ->references('idEmpleado')
                ->on('empleados')
                ->onDelete('restrict');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
