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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categoria_id')->constrained('categorias');
        $table->foreignId('unidad_medida_id')->constrained('unidades_medida');

        $table->string('codigo', 50)->unique()->nullable();
        $table->string('nombre', 150);
        $table->text('descripcion')->nullable();

        $table->decimal('stock_actual', 10, 2)->default(0);
        $table->decimal('stock_minimo', 10, 2)->default(0);

        $table->decimal('precio_compra', 10, 2)->nullable();
        $table->decimal('precio_venta', 10, 2)->nullable();

        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');

        $table->timestamp('created_at')->useCurrent();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('productos');
}
};
