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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');  
            $table->string('nombre_p', 50);
            $table->string('marca_p', 50);
            $table->unsignedBigInteger('id_cate');
            $table->string('material', 50);
            $table->string('descripcion', 120);
            $table->decimal('precio', 12, 2);
            $table->binary('imagen')->nullable();
            $table->string('estado', 20);

            // Foreign key
            $table->foreign('id_cate')
                ->references('id_cate')
                ->on('categorias')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
