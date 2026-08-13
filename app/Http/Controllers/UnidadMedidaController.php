<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidades = UnidadMedida::latest('id')->paginate(10);
        return view('unidades_medida.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades_medida.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:50',
            'abreviatura' => 'required|string|max:10',
        ]);

        UnidadMedida::create($validated);

        return redirect()->route('unidades-medida.index')
            ->with('success', 'Unidad de medida creada correctamente.');
    }

    public function edit(UnidadMedida $unidades_medidum)
    {
        $unidad = $unidades_medidum;
        return view('unidades_medida.edit', compact('unidad'));
    }

    public function update(Request $request, UnidadMedida $unidades_medidum)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:50',
            'abreviatura' => 'required|string|max:10',
        ]);

        $unidades_medidum->update($validated);

        return redirect()->route('unidades-medida.index')
            ->with('success', 'Unidad de medida actualizada.');
    }

    public function destroy(UnidadMedida $unidades_medidum)
    {
        $unidades_medidum->delete();

        return redirect()->route('unidades-medida.index')
            ->with('success', 'Unidad de medida eliminada.');
    }
}