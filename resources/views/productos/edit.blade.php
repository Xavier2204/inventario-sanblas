@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Editar Producto / Insumo</h2>
        <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('productos.update', $producto) }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Categoría *</label>
                <select name="categoria_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Unidad de Medida *</label>
                <select name="unidad_medida_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                    @foreach($unidades as $u)
                        <option value="{{ $u->id }}" {{ old('unidad_medida_id', $producto->unidad_medida_id) == $u->id ? 'selected' : '' }}>{{ $u->nombre }} ({{ $u->abreviatura }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo', $producto->codigo) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="2" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Actual *</label>
                <input type="number" step="0.01" name="stock_actual" value="{{ old('stock_actual', $producto->stock_actual) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Mínimo *</label>
                <input type="number" step="0.01" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Precio Compra ($)</label>
                <input type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra', $producto->precio_compra) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Precio Venta ($)</label>
                <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                <option value="Activo" {{ $producto->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $producto->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="pt-4 flex justify-between items-center">
            <button type="button" onclick="if(confirm('¿Inactivar este producto?')) document.getElementById('delete-form').submit();" class="text-xs text-red-600 hover:underline">
                Desactivar producto
            </button>

            <div class="flex space-x-3">
                <a href="{{ route('productos.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Actualizar</button>
            </div>
        </div>
    </form>

    <form id="delete-form" action="{{ route('productos.destroy', $producto) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection