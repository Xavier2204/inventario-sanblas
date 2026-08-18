<?php

namespace App\Observers;

use App\Models\Auditoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditoriaObserver
{
    public function created(Model $model): void
    {
        $this->registrar('Creación', $model);
    }

    public function updated(Model $model): void
    {
        $this->registrar('Actualización', $model);
    }

    public function deleted(Model $model): void
    {
        $this->registrar('Eliminación', $model);
    }

    private function registrar(string $accion, Model $model): void
    {
        $usuarioId = Auth::check() ? Auth::id() : null;
        $tabla = $model->getTable();

        // 1. Buscamos un nombre representativo en el modelo (si existe)
        $identificador = $model->nombre 
            ?? $model->nombres 
            ?? $model->descripcion 
            ?? $model->razon_social 
            ?? "ID #{$model->getKey()}";

        // 2. Construimos una descripción clara para la bitácora
        $detalles = match ($accion) {
            'Creación'      => "Se registró el elemento '{$identificador}'",
            'Actualización' => "Se modificaron los datos de '{$identificador}'",
            'Eliminación'   => "Se eliminó el registro '{$identificador}'",
            default         => "Acción {$accion} en '{$identificador}'",
        };

        // 3. Guardamos en la base de datos
        Auditoria::create([
            'usuario_id'     => $usuarioId,
            'accion'         => $accion,
            'tabla_afectada' => $tabla,
            'detalles'       => $detalles,
            'fecha'          => now(),
        ]);
    }
}