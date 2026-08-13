<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    public $timestamps = false; // solo created_at, sin updated_at

    protected $fillable = [
        'categoria_id',
        'unidad_medida_id',
        'codigo',
        'nombre',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'stock_actual' => 'decimal:2',
            'stock_minimo' => 'decimal:2',
            'precio_compra' => 'decimal:2',
            'precio_venta' => 'decimal:2',
        ];
    }

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }

    public function detalleEntradas()
    {
        return $this->hasMany(DetalleEntrada::class, 'producto_id');
    }

    public function detalleSalidas()
    {
        return $this->hasMany(DetalleSalida::class, 'producto_id');
    }

    // Útil para saber si hay que reabastecer
    public function getNecesitaReabastecerAttribute(): bool
    {
        return $this->stock_actual <= $this->stock_minimo;
    }
}