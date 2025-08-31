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
        Schema::table('tallas', function (Blueprint $table) {
            $table->renameColumn('id_talla', 'idTalla');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tallas', function (Blueprint $table) {
            $table->renameColumn('idTalla', 'id_talla');
        });
    }
};

