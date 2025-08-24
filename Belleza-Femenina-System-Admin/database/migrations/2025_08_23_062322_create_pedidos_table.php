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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('idPedido')->autoIncrement();
            $table->unsignedBigInteger('idCliente'); // Cliente que hizo el pedido
            $table->unsignedBigInteger('idEmpleado')->nullable(); // Empleado que atendió el pedido
            $table->timestamp('fecha')->useCurrent();
            $table->string('direccion', 200);
            $table->enum('estado', [
                'pendiente',
                'confirmado',
                'procesando',
                'enviado',
                'entregado',
                'cancelado'
            ])->default('pendiente');
            $table->decimal('total', 12, 2);
            $table->text('observaciones')->nullable();

            // Relaciones
            $table->foreign('idCliente')
                ->references('idCliente')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('idEmpleado')
                ->references('idEmpleado')
                ->on('empleados')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
