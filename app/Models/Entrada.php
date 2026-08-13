<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas';

    public $timestamps = false; // solo tenemos "fecha", no created_at/updated_at

    protected $fillable = [
        'usuario_id',
        'proveedor_id',
        'fecha',
        'numero_factura',
        'observacion',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'total' => 'decimal:2',
        ];
    }

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleEntrada::class, 'entrada_id');
    }
}