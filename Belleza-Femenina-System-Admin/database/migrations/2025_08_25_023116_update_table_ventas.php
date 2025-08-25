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
        Schema::table('ventas', function (Blueprint $table) {
          
            $table->dropForeign(['user_id']);                 
            $table->dropColumn('user_id');
            $table->integer('idCliente');
            $table->foreign('idCliente')                             
                ->references('idCliente')
                ->on('clientes')
                ->onDelete('restrict');

            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('ventas', function (Blueprint $table) {
            $table->timestamps();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            $table->dropForeign(['idCliente']);
            $table->dropColumn('idCliente');
        });
    }
};
