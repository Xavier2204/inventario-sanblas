<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->latest('id')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rol_id'    => 'required|exists:roles,id',
            'nombres'   => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo'    => 'nullable|email|max:100|unique:usuarios,correo',
            'usuario'   => 'required|string|max:50|unique:usuarios,usuario',
            'password'  => 'required|string|min:6',
            'estado'    => 'required|in:Activo,Inactivo',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Usuario::create($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'rol_id'    => 'required|exists:roles,id',
            'nombres'   => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo'    => ['nullable', 'email', 'max:100', Rule::unique('usuarios')->ignore($usuario->id)],
            'usuario'   => ['required', 'string', 'max:50', Rule::unique('usuarios')->ignore($usuario->id)],
            'password'  => 'nullable|string|min:6',
            'estado'    => 'required|in:Activo,Inactivo',
        ]);

        // Si ingresó una nueva contraseña, la encriptamos; de lo contrario mantenemos la actual
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->update(['estado' => 'Inactivo']);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario desactivado con éxito.');
    }
}