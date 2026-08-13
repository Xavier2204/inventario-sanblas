<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    // Indica explícitamente que la clave primaria numérica es 'id'
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'rol_id',
        'nombres',
        'apellidos',
        'correo',
        'usuario',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // ==========================================
    // HELPERS DE PERMISOS Y ROLES
    // ==========================================

    /**
     * Evalúa si el usuario es Administrador.
     */
    public function esAdmin(): bool
    {
        if (!$this->rol) return false;

        return str_contains(strtolower($this->rol->nombre), 'admin');
    }

    /**
     * Evalúa si el usuario pertenece a Bodega / Almacén.
     */
    public function esBodeguero(): bool
    {
        if (!$this->rol) return false;

        $nombreRol = strtolower($this->rol->nombre);

        return str_contains($nombreRol, 'bodega')
            || str_contains($nombreRol, 'bodeguero')
            || str_contains($nombreRol, 'almacén')
            || str_contains($nombreRol, 'almacen');
    }

    /**
     * Evalúa si el usuario es de Cocina.
     */
    public function esCocina(): bool
    {
        if (!$this->rol) return false;

        $nombreRol = strtolower($this->rol->nombre);

        return str_contains($nombreRol, 'cocina')
            || str_contains($nombreRol, 'chef');
    }

    // ==========================================
    // RELACIONES DE BASE DE DATOS
    // ==========================================

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'usuario_id');
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class, 'usuario_id');
    }

    public function auditorias()
    {
        return $this->hasMany(Auditoria::class, 'usuario_id');
    }
}