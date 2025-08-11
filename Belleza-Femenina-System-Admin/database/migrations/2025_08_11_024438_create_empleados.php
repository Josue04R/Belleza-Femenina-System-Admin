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
        Schema::create('empleados', function (Blueprint $table) {
           $table->id('idEmpleado');
            $table->string('nombre',30);
            $table->string('apellido',30);
            $table->string('telefono',9);
            $table->string('usuario');
            $table->string('contrasenia');
            $table->integer('idPermiso');

            $table->foreign('idPermiso')
                ->references('idPermiso')
                ->on('permisos')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
