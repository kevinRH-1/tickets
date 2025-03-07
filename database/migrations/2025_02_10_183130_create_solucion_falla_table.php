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
        Schema::create('solucion_falla', function (Blueprint $table) {
            $table->id();
            $table->integer('falla_id');
            $table->integer('tipo');
            $table->text('solucion')->nullable();
            $table->integer('tecnico_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solucion_falla');
    }
};
