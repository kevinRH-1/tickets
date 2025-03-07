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
        Schema::create('tipo_falla_software', function (Blueprint $table) {
            $table->id();
            $table->integer('sistema_id');
            $table->integer('modulo_id')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('nivel_riesgo');
            $table->integer('activo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_falla_software');
    }
};
