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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('roles');
    
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
    
            $table->string('correo', 100)->unique()->nullable();
            $table->string('usuario', 50)->unique();
            $table->string('password');
    
            $table->rememberToken();
    
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
    
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('usuarios');
}
};
