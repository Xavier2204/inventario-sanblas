@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Productos con Stock Bajo</h1>
            <p class="text-xs text-slate-500">{{ $productos->count() }} producto(s) requieren reabastecimiento</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('reportes.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 px-3 py-2">
                ← Volver
            </a>
            <a href="{{ route('reportes.stock-bajo.pdf') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-lg shadow transition">
                Descargar PDF
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Código</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Producto</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Categoría</th>
                    <th class="px-4 py-3 text-right text-xs font-bold text-slate-500 uppercase">Stock Actual</th>
                    <th class="px-4 py-3 text-right text-xs font-bold text-slate-500 uppercase">Stock Mínimo</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Unidad</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($productos as $producto)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $producto->codigo }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $producto->nombre }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $producto->categoria->nombre ?? '—' }}</td>
                        <td class="px-4 py-3 text-right">
                            <span class="bg-red-100 text-red-700 font-bold text-xs px-2 py-1 rounded">
                                {{ number_format($producto->stock_actual, 2) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right text-slate-600">{{ number_format($producto->stock_minimo, 2) }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $producto->unidadMedida->abreviatura ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-400">
                            ✅ No hay productos con stock bajo por el momento.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection