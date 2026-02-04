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
        Schema::create('documentos', function (Blueprint $table) {
           $table->id();
        $table->foreignId('legajo_id')->constrained()->onDelete('cascade');
        $table->string('nombre_documento'); // Ej: Acta de Nacimiento
        $table->string('descripcion')->nullable(); // Ej: Original, Copia, Legible
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
