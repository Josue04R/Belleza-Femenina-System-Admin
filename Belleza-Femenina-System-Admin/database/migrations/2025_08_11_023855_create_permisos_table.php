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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id('idPermiso');
            $table->string('nombrePermiso',15);
            $table->boolean('categoriaProductos');
            $table->boolean('productos');
            $table->boolean('tallas');
            $table->boolean('variantesProducto');
            $table->boolean('empleados');
            $table->boolean('permisos');
            $table->boolean('registroVentas');
            $table->boolean('ventas');
            $table->boolean('compras');
            $table->boolean('pedidos');
            $table->boolean('gastosOperativos');
            $table->boolean('inventario');
            $table->boolean('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
