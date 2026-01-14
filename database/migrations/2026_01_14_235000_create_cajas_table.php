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
        Schema::create('cajas', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique(); // El número para el código de barras
        $table->text('descripcion')->nullable();
        
        // Relación con Categorías
        $table->foreignId('categoria_id')
              ->constrained('categorias') // Nombre de tu tabla de categorías
              ->onDelete('cascade'); // Si borras la categoría, se borran sus cajas
              
        $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
