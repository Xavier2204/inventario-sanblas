<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditoria';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'accion',
        'tabla_afectada',
        'detalles',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
        ];
    }

    // Relación
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}