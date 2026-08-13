<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    use HasFactory;

    protected $table = 'detalle_salidas';

    public $timestamps = false;

    protected $fillable = [
        'salida_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',
            'precio_unitario' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    // Relaciones
    public function salida()
    {
        return $this->belongsTo(Salida::class, 'salida_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}