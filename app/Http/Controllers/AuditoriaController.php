<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Auditoria::with('usuario')->orderByDesc('fecha');

        // Filtro opcional por usuario
        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }

        // Filtro opcional por tabla afectada
        if ($request->filled('tabla_afectada')) {
            $query->where('tabla_afectada', $request->tabla_afectada);
        }

        $auditorias = $query->paginate(20);

        return view('auditoria.index', compact('auditorias'));
    }
}