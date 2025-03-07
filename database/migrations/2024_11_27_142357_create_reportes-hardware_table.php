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
        Schema::create('reportes_hardware', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('idusuario');
            $table->string('idequipo');
            $table->integer('categoria_id');
            $table->string('idtecnico')->nullable();
            // $table->string('categoria_falla_id')->nullable();
            $table->string('falla_id')->nullable();
            $table->string('descripcion');
            $table->string('solucion')->nullable();
            $table->string('status_id');
            $table->string('solucionado_usuario');
            $table->string('solucionado_tecnico');
            $table->string('tipo_solucion')->nullable();
            $table->string('tiempo_revision')->nullable();
            $table->string('tiempo_solucion')->nullable();
            $table->integer('noti_t')->nullable();
            $table->integer('noti_u')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
