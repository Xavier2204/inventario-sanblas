<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::latest('id')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa'         => 'nullable|string|max:150',
            'nombre_contacto' => 'nullable|string|max:100',
            'telefono'        => 'nullable|string|max:20',
            'correo'          => 'nullable|email|max:100',
            'direccion'       => 'nullable|string',
            'estado'          => 'required|in:Activo,Inactivo',
        ]);

        Proveedor::create($validated);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    public function edit(Proveedor $proveedore)
    {
        $proveedor = $proveedore;
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $validated = $request->validate([
            'empresa'         => 'nullable|string|max:150',
            'nombre_contacto' => 'nullable|string|max:100',
            'telefono'        => 'nullable|string|max:20',
            'correo'          => 'nullable|email|max:100',
            'direccion'       => 'nullable|string',
            'estado'          => 'required|in:Activo,Inactivo',
        ]);

        $proveedore->update($validated);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado.');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->update(['estado' => 'Inactivo']);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor inactivado.');
    }
}