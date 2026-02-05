<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('guardias', function (Blueprint $table) {
        // Creamos una columna para un código tipo "G-2026-XXXX"
        $table->string('codigo_unico')->unique()->after('id')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guardias', function (Blueprint $table) {
            //
        });
    }
};
