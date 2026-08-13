<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest('id')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado'      => 'required|in:Activo,Inactivo',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado'      => 'required|in:Activo,Inactivo',
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        // En lugar de borrar físicamente si tiene productos asociados, inactivamos
        $categoria->update(['estado' => 'Inactivo']);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría desactivada con éxito.');
    }
}