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
    Schema::create('salidas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuario_id')->constrained('usuarios');

        $table->timestamp('fecha')->useCurrent();

        $table->enum('motivo', [
            'Venta',
            'Producción',
            'Daño',
            'Caducado',
            'Merma',
            'Consumo interno',
            'Otro',
        ]);

        $table->text('observacion')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('salidas');
}
};
