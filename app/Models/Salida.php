<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salidas';

    public $timestamps = false; // solo tenemos "fecha"

    protected $fillable = [
        'usuario_id',
        'fecha',
        'motivo',
        'observacion',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
        ];
    }

    // Accesor para calcular el total dinámicamente desde los detalles
    public function getTotalAttribute(): float
    {
        return (float) $this->detalles->sum('subtotal');
    }

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleSalida::class, 'salida_id');
    }
}