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
        Schema::table('permisos', function (Blueprint $table) {
            // Eliminar columnas antiguas
            $table->dropColumn(['categoriaProductos', 'productos', 'tallas', 'variantesProducto']);

            // Agregar la nueva columna
            $table->boolean('gestionProductos')->after('nombrePermiso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            
        Schema::table('permisos', function (Blueprint $table) {
            $table->boolean('categoriaProductos');
            $table->boolean('productos');
            $table->boolean('tallas');
            $table->boolean('variantesProducto');
            $table->dropColumn('gestionProductos');
        });
      
    }
};
