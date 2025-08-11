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
        Schema::create('logs', function (Blueprint $table) {
            $table->id('idLog');
            $table->integer('idEmpleado');
            $table->string('accion');
            $table->string('descripcion');
            $table->timestamps();

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
        Schema::dropIfExists('logs');
    }
};
