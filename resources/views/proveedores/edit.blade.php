@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Editar Proveedor</h2>
        <a href="{{ route('proveedores.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('proveedores.update', $proveedor) }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Empresa</label>
                <input type="text" name="empresa" value="{{ old('empresa', $proveedor->empresa) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre de Contacto</label>
                <input type="text" name="nombre_contacto" value="{{ old('nombre_contacto', $proveedor->nombre_contacto) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="correo" value="{{ old('correo', $proveedor->correo) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
            <textarea name="direccion" rows="2" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">{{ old('direccion', $proveedor->direccion) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="Activo" {{ $proveedor->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $proveedor->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="pt-4 flex justify-between items-center">
            <button type="button" onclick="if(confirm('¿Desactivar este proveedor?')) document.getElementById('delete-form').submit();" class="text-xs text-red-600 hover:underline">
                Desactivar proveedor
            </button>

            <div class="flex space-x-3">
                <a href="{{ route('proveedores.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Actualizar</button>
            </div>
        </div>
    </form>

    <form id="delete-form" action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection