<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ReporteController;

// 1. REDIRECCIÓN INICIAL
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. DASHBOARD REDIRIGIDO SEGÚN ROL
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Administrador: Va al Dashboard real
    if ($user->esAdmin()) {
        return view('dashboard');
    }

    // Bodeguero: Redirige automáticamente a Entradas
    if ($user->esBodeguero()) {
        return redirect()->route('entradas.index');
    }

    // Cocina: Redirige automáticamente a Consumo Diario (Salidas)
    if ($user->esCocina()) {
        return redirect()->route('salidas.index');
    }

    // Fallback general por si no tiene rol definido
    return redirect()->route('productos.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. RUTAS AUTENTICADAS
Route::middleware(['auth'])->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulos Compartidos (Administrador, Bodeguero y Cocina)
    Route::resource('productos', ProductoController::class);
    Route::resource('salidas', SalidaController::class);
    Route::resource('entradas', EntradaController::class);

    // Módulos de Administrador + Bodeguero
    Route::middleware(['role:Administrador,Bodeguero'])->group(function () {
        Route::resource('unidades-medida', UnidadMedidaController::class);
        Route::resource('categorias', CategoriaController::class);
    });

    // Módulos Exclusivos de Administrador
    Route::middleware(['role:Administrador'])->group(function () {
        Route::resource('proveedores', ProveedorController::class);
        Route::resource('usuarios', UsuarioController::class);
        Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

        // Reportes
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('reportes/stock-bajo', [ReporteController::class, 'stockBajo'])->name('reportes.stock-bajo');
        Route::get('reportes/stock-bajo/pdf', [ReporteController::class, 'stockBajoPdf'])->name('reportes.stock-bajo.pdf');
    });

});

require __DIR__.'/auth.php';