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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id('idDetallePedido');
            $table->unsignedBigInteger('idPedido');
            $table->unsignedBigInteger('id_variantes')->nullable();
            $table->integer('cantidad');
            $table->decimal('precioUnitario', 12, 2);
            $table->decimal('subtotal', 12, 2);

            // Relaciones
            $table->foreign('idPedido')
                ->references('idPedido')
                ->on('pedidos')
                ->onDelete('cascade');


           $table->foreign('id_variantes')
            ->references('id_variantes')
            ->on('variantes_productos')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallePedidos');
    }
};
