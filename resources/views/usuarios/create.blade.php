@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Crear Nuevo Usuario</h2>
            <p class="text-xs text-gray-500">Registra un nuevo miembro del personal y asigna su rol</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    {{-- Mostrar alertas si la validación falla --}}
    @if ($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-700 space-y-1">
            <strong class="font-bold">Por favor corrige los siguientes errores:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf

        <!-- Nombres y Apellidos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombres *</label>
                <input type="text" name="nombres" value="{{ old('nombres') }}" required placeholder="Ej: Carlos" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellidos *</label>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required placeholder="Ej: Mendoza" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <!-- Usuario y Correo Electrónico -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Usuario (Login) *</label>
                <input type="text" name="usuario" value="{{ old('usuario') }}" required placeholder="Ej: cmendoza" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="correo" value="{{ old('correo') }}" placeholder="carlos@sanblas.com" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <!-- Rol y Estado -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Rol / Permisos *</label>
                <select name="rol_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm bg-white">
                    <option value="">-- Seleccionar Rol --</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}" {{ old('rol_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado *</label>
                <select name="estado" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm bg-white">
                    <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>🟢 Activo</option>
                    <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>🔴 Inactivo</option>
                </select>
            </div>
        </div>

        <!-- Contraseña -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña *</label>
            <input type="password" name="password" required placeholder="••••••••" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
            <a href="{{ route('usuarios.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">
                Guardar Usuario
            </button>
        </div>
    </form>

</div>
@endsection