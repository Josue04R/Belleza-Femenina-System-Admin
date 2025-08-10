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
        Schema::create('variantes_productos', function (Blueprint $table) {
            $table->id('id_variantes');  
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_talla');
            $table->string('color', 30);
            $table->integer('stock');
            $table->decimal('precio', 12, 2);
            

            // Foreign keys
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variantes_productos');
    }
};
