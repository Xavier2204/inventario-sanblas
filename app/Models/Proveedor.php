<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    public $timestamps = false;

    protected $fillable = [
        'empresa',
        'nombre_contacto',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];

    // Relación: un proveedor tiene muchas entradas (compras)
    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'proveedor_id');
    }
}