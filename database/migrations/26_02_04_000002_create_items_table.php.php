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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('tipo'); // Radio, Chaleco, Esposas, etc.
        $table->string('modelo');
        $table->string('serie')->unique(); // Número de serie del equipo
        
        // Relación: Crea la columna guardia_id que apunta a la tabla guardias
        $table->foreignId('guardia_id')
              ->constrained('guardias')
              ->onDelete('cascade'); // Si borras al guardia, se borra su registro de equipo
              
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
