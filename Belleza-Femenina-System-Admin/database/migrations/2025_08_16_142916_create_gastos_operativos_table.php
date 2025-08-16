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
        Schema::create('gastos_operativos', function (Blueprint $table) {
            $table->id('idGasto'); 
            $table->date('fecha'); 
            $table->string('categoria', 100); 
            $table->text('descripcion');
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago', 50);
            
            //relacion con la tabla empleados
            $table->unsignedBigInteger('idEmpleado');
            $table->foreign('idEmpleado')
                  ->references('idEmpleado')
                  ->on('empleados')
                  ->onDelete('cascade'); 

            $table->text('observaciones')->nullable();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_operativos');
    }
};
