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
        Schema::create('mensajes_reporte', function (Blueprint $table) {
            $table->id();
            $table->integer('reporte_id')->nullable();
            // $table->foreign('reporte_id')->references('id')->on('reportes_hardware')->onDelete('set null');
            $table->integer('tipo_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
            $table->text('mensaje');
            $table->longText('imagen')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes_reporte');
    }
};
