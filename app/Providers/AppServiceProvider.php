<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

// Importamos los modelos REALES de tu sistema de Inventario
use App\Models\Producto;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Proveedor;
use App\Models\Usuario;
use App\Observers\AuditoriaObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Registro de los observadores para las tablas del Inventario
        Producto::observe(AuditoriaObserver::class);
        Entrada::observe(AuditoriaObserver::class);
        Salida::observe(AuditoriaObserver::class);
        Proveedor::observe(AuditoriaObserver::class);
        Usuario::observe(AuditoriaObserver::class);
    }
}