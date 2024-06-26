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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('body');
            $table->string('fuel');
            $table->string('gears');
            $table->integer('engine');
            $table->integer('horsepower');
            $table->integer('seats');
            $table->string('color');
            $table->decimal('price_per_hour', 8, 2);
            $table->boolean('available')->default(true); // New field for availability, default to true
            $table->boolean('rented')->default(false); // New field for rental status, default to false
            $table->string('description');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
