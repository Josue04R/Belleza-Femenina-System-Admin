<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['id_cate']);
        });

        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'id_producto')) {
                $table->renameColumn('id_producto', 'idProducto');
            }

            if (Schema::hasColumn('productos', 'nombre_p')) {
                $table->renameColumn('nombre_p', 'nombreProducto');
            }
            if (Schema::hasColumn('productos', 'marca_p')) {
                $table->renameColumn('marca_p', 'marcaProducto');
            }

            if (Schema::hasColumn('productos', 'id_cate')) {
                $table->renameColumn('id_cate', 'idCategoria');
            }
        });

       
        Schema::table('productos', function (Blueprint $table) {
            $table->foreign('idCategoria')
                  ->references('idCategoria')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
       
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });

        
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'idProducto')) {
                $table->renameColumn('idProducto', 'id_producto');
            }
            if (Schema::hasColumn('productos', 'nombreProducto')) {
                $table->renameColumn('nombreProducto', 'nombre_p');
            }
            if (Schema::hasColumn('productos', 'marcaProducto')) {
                $table->renameColumn('marcaProducto', 'marca_p');
            }
            if (Schema::hasColumn('productos', 'idCategoria')) {
                $table->renameColumn('idCategoria', 'id_cate');
            }
        });

       
        Schema::table('productos', function (Blueprint $table) {
            $table->foreign('id_cate')
                  ->references('id_cate')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }
};

