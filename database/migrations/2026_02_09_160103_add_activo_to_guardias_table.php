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
        Schema::table('guardias', function (Blueprint $table) {
            // Creamos la columna 'activo' (booleano) con valor predeterminado true (1)
            $table->boolean('activo')->default(true)->after('cedula');
        });
    }

    public function down(): void
    {
        Schema::table('guardias', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
};
