<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    public $timestamps = false; // tu esquema no tiene created_at/updated_at aquí

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relación: una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}