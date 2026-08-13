@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Nuevo Producto / Insumo</h2>
        <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('productos.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Categoría *</label>
                <select name="categoria_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                    <option value="">Seleccione Categoría</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Unidad de Medida *</label>
                <select name="unidad_medida_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                    <option value="">Seleccione Unidad</option>
                    @foreach($unidades as $u)
                        <option value="{{ $u->id }}" {{ old('unidad_medida_id') == $u->id ? 'selected' : '' }}>{{ $u->nombre }} ({{ $u->abreviatura }})</option>
                    @endforeach
                </select>
                @error('unidad_medida_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Código de Producto (Opcional / Código de Barras)</label>
                <input type="text" name="codigo" value="{{ old('codigo') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm @error('codigo') border-red-500 @enderror">
                @error('codigo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Insumo / Producto *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm @error('nombre') border-red-500 @enderror">
                @error('nombre') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="2" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">{{ old('descripcion') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Inicial *</label>
                <input type="number" step="0.01" name="stock_actual" value="{{ old('stock_actual', 0) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Mínimo (Alerta) *</label>
                <input type="number" step="0.01" name="stock_minimo" value="{{ old('stock_minimo', 0) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Precio Compra ($)</label>
                <input type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra', 0) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Precio Venta ($)</label>
                <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', 0) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="pt-4 flex justify-end space-x-3">
            <a href="{{ route('productos.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Guardar Producto</button>
        </div>
    </form>

</div>
@endsection