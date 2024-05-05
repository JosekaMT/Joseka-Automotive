<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the rentals table.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id(); // ID único para cada alquiler
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla de usuarios
            $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Relación con la tabla de coches
            $table->dateTime('start_date'); // Fecha y hora de inicio del alquiler
            $table->dateTime('end_date'); // Fecha y hora de finalización del alquiler
            $table->decimal('total_price', 10, 2); // Precio total del alquiler
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending'); // Estado del alquiler
            $table->string('brand'); // Marca del coche, redundante pero útil para consultas rápidas
            $table->string('model'); // Modelo del coche, igualmente redundante pero útil
            $table->string('image1'); // Imagen principal del coche, para referencia rápida
            $table->timestamps(); // Marca de tiempo para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
