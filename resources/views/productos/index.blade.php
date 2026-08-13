@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado y Acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Inventario de Insumos / Productos</h2>
            <p class="text-sm text-gray-500">Control de stock, precios y alertas de inventario mínimo</p>
        </div>
        <a href="{{ route('productos.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-sm shadow transition">
            + Nuevo Producto
        </a>
    </div>

    <!-- Buscador -->
    <div class="bg-white p-4 rounded-xl shadow border border-gray-100">
        <form method="GET" action="{{ route('productos.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por código o nombre..." class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm">
            <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-sm font-medium">Buscar</button>
            @if(request('search'))
                <a href="{{ route('productos.index') }}" class="px-3 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50 flex items-center">Limpiar</a>
            @endif
        </form>
    </div>

    <!-- Vista Escritorio (Tabla) -->
    <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">Código / Nombre</th>
                    <th class="p-4">Categoría</th>
                    <th class="p-4">Stock Actual</th>
                    <th class="p-4">P. Compra / Venta</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($productos as $prod)
                @php $bajoStock = $prod->stock_actual <= $prod->stock_minimo; @endphp
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-slate-800">{{ $prod->nombre }}</div>
                        <div class="text-xs text-gray-400">Cód: {{ $prod->codigo ?? 'N/A' }}</div>
                    </td>
                    <td class="p-4 text-gray-600">{{ $prod->categoria->nombre ?? 'Sin Categoria' }}</td>
                    <td class="p-4">
                        <span class="font-bold text-base {{ $bajoStock ? 'text-red-600' : 'text-slate-800' }}">
                            {{ number_format($prod->stock_actual, 2) }} {{ $prod->unidadMedida->abreviatura ?? '' }}
                        </span>
                        @if($bajoStock)
                            <span class="block text-[10px] font-bold text-red-500 uppercase tracking-wider">⚠️ Stock Bajo (Mín: {{ $prod->stock_minimo }})</span>
                        @endif
                    </td>
                    <td class="p-4 text-xs text-gray-600">
                        <div>C: ${{ number_format($prod->precio_compra, 2) }}</div>
                        <div>V: ${{ number_format($prod->precio_venta, 2) }}</div>
                    </td>
                    <td class="p-4">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full {{ $prod->estado === 'Activo' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                            {{ $prod->estado }}
                        </span>
                    </td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('productos.edit', $prod) }}" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">No hay productos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista Móvil (Tarjetas) -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($productos as $prod)
        @php $bajoStock = $prod->stock_actual <= $prod->stock_minimo; @endphp
        <div class="bg-white p-4 rounded-xl shadow border {{ $bajoStock ? 'border-red-300 bg-red-50/20' : 'border-gray-100' }} space-y-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs text-gray-400">Cód: {{ $prod->codigo ?? 'N/A' }}</span>
                    <h3 class="font-bold text-slate-800 text-lg">{{ $prod->nombre }}</h3>
                    <p class="text-xs text-slate-500">🏷️ {{ $prod->categoria->nombre ?? 'Sin Categoría' }}</p>
                </div>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $prod->estado === 'Activo' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                    {{ $prod->estado }}
                </span>
            </div>

            <div class="flex justify-between items-center p-2.5 bg-slate-50 rounded-lg text-xs">
                <div>
                    <span class="text-gray-500 block">Stock Actual:</span>
                    <span class="font-bold text-sm {{ $bajoStock ? 'text-red-600' : 'text-slate-800' }}">
                        {{ number_format($prod->stock_actual, 2) }} {{ $prod->unidadMedida->abreviatura ?? '' }}
                    </span>
                    @if($bajoStock)
                        <span class="block text-[10px] text-red-500 font-bold">⚠️ Bajo Mínimo ({{ $prod->stock_minimo }})</span>
                    @endif
                </div>
                <div class="text-right">
                    <span class="text-gray-500 block">Precios:</span>
                    <span class="block">Compra: ${{ number_format($prod->precio_compra, 2) }}</span>
                    <span class="block">Venta: ${{ number_format($prod->precio_venta, 2) }}</span>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100 flex justify-end">
                <a href="{{ route('productos.edit', $prod) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1.5 rounded-md font-semibold">Editar</a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-400 shadow">
            No hay productos registrados.
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pt-2">
        {{ $productos->links() }}
    </div>

</div>
@endsection