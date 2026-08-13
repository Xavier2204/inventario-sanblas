@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Nuevo Proveedor</h2>
        <a href="{{ route('proveedores.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('proveedores.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre de la Empresa</label>
                <input type="text" name="empresa" value="{{ old('empresa') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre de Contacto</label>
                <input type="text" name="nombre_contacto" value="{{ old('nombre_contacto') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="correo" value="{{ old('correo') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm @error('correo') border-red-500 @enderror">
                @error('correo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
            <textarea name="direccion" rows="2" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">{{ old('direccion') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="pt-4 flex justify-end space-x-3">
            <a href="{{ route('proveedores.index') }}" class="px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Guardar Proveedor</button>
        </div>
    </form>

</div>
@endsection