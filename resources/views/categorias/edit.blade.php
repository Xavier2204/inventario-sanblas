@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Editar Categoría</h2>
        <a href="{{ route('categorias.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre *</label>
            <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">{{ old('descripcion', $categoria->descripcion) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="Activo" {{ $categoria->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $categoria->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="pt-4 flex justify-between items-center">
            <button type="button" onclick="if(confirm('¿Inactivar esta categoría?')) document.getElementById('delete-form').submit();" class="text-xs text-red-600 hover:underline">
                Desactivar categoría
            </button>

            <div class="flex space-x-3">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Actualizar</button>
            </div>
        </div>
    </form>

    <form id="delete-form" action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection