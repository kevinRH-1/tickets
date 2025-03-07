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
        Schema::create('solucion', function (Blueprint $table) {
            $table->id();
            $table->integer('reporte_id');
            $table->integer('tipo_reporte');
            // $table->foreign('reporte_id')->references('id')->on('reportes_hardware')->onDelete('set null');
            $table->string('tipo_solucion')->nullable();
            $table->text('solucion_mensaje')->nullable();
            $table->integer('tecnico_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solucion');
    }
};
