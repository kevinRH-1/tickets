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
        Schema::create('tipo_fallas', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('categoria_id')->nullable();
            // $table->foreign('categoria_id')->references('id')->on('categoria_fallas')->onDelete('set null');
            $table->string('desc');
            $table->integer('nivel_riesgo');
            $table->integer('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_fallas');
    }
};
