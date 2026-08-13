@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Editar Usuario</h2>
        <a href="{{ route('usuarios.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo *</label>
            <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico *</label>
            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Rol / Permisos *</label>
            <select name="rol" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="Administrador" {{ $usuario->rol == 'Administrador' ? 'selected' : '' }}>👑 Administrador (Acceso Total)</option>
                <option value="Cocina / Almacén" {{ $usuario->rol == 'Cocina / Almacén' ? 'selected' : '' }}>👨‍🍳 Cocina / Almacén (Gestión de Stock)</option>
                <option value="Cajero / Mesero" {{ $usuario->rol == 'Cajero / Mesero' ? 'selected' : '' }}>🧑‍💼 Cajero / Mesero (Registro de Ventas)</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado en Sistema</label>
            <select name="activo" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="1" {{ $usuario->activo ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$usuario->activo ? 'selected' : '' }}>Inactivo (Acceso Bloqueado)</option>
            </select>
        </div>

        <div class="border-t border-gray-100 pt-4 space-y-3">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Cambiar Contraseña (Dejar en blanco para mantener la actual)</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Nueva Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
            <a href="{{ route('usuarios.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">
                Actualizar Usuario
            </button>
        </div>
    </form>

</div>
@endsection