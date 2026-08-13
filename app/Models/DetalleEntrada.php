<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEntrada extends Model
{
    use HasFactory;

    protected $table = 'detalle_entradas';

    public $timestamps = false;

    protected $fillable = [
        'entrada_id',
        'producto_id',
        'cantidad',
        'precio',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',
            'precio' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    // Relaciones
    public function entrada()
    {
        return $this->belongsTo(Entrada::class, 'entrada_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}