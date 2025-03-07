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
        Schema::create('reportes_softwares', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->integer('usuario_id');
            $table->integer('sistema_id');
            $table->integer('modulo_id')->nullable();
            $table->integer('tecnico_id')->nullable();
            $table->integer('falla_comun_id')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('solucionado_tecnico');
            $table->integer('solucionado_usuario');
            $table->integer('status_id');
            $table->dateTime('tiempo_revision')->nullable();
            $table->datetime('tiempo_solucion')->nullable();
            $table->string('img')->nullable();
            $table->integer('noti_t')->nullable();
            $table->integer('noti_u')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_softwares');
    }
};
