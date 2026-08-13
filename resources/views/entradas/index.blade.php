@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado y Botón Crear -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Entradas de Inventario</h2>
            <p class="text-sm text-gray-500">Registro de compras e ingresos de insumos a bodega</p>
        </div>
        <a href="{{ route('entradas.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-sm shadow transition">
            + Registrar Entrada
        </a>
    </div>

    <!-- Vista Escritorio (Tabla) -->
    <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">N° Comprobante</th>
                    <th class="p-4">Proveedor</th>
                    <th class="p-4">Fecha</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($entradas as $e)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 font-bold text-slate-800">
                        {{ $e->numero_comprobante ?? 'ENT-' . str_pad($e->id, 5, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="p-4 text-gray-600">{{ $e->proveedor->empresa ?? 'Proveedor General' }}</td>
                    <td class="p-4 text-gray-500 text-xs">{{ \Carbon\Carbon::parse($e->fecha)->format('d/m/Y H:i') }}</td>
                    <td class="p-4 font-bold text-slate-800">${{ number_format($e->total, 2) }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full {{ $e->estado === 'Completada' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $e->estado }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('entradas.show', $e) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-2.5 py-1.5 rounded-md">Ver Detalle</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">No hay registros de entradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista Móvil (Tarjetas) -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($entradas as $e)
        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 space-y-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs text-gray-400">Comprobante</span>
                    <h3 class="font-bold text-slate-800 text-base">
                        {{ $e->numero_comprobante ?? 'ENT-' . str_pad($e->id, 5, '0', STR_PAD_LEFT) }}
                    </h3>
                </div>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $e->estado === 'Completada' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $e->estado }}
                </span>
            </div>

            <div class="text-xs space-y-1 text-gray-600">
                <p>🚚 <strong>Proveedor:</strong> {{ $e->proveedor->empresa ?? 'Proveedor General' }}</p>
                <p>📅 <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($e->fecha)->format('d/m/Y H:i') }}</p>
            </div>

            <div class="pt-2 border-t border-gray-100 flex justify-between items-center">
                <span class="text-base font-bold text-slate-800">${{ number_format($e->total, 2) }}</span>
                <a href="{{ route('entradas.show', $e) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1.5 rounded-md font-semibold">Ver Detalle</a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-400 shadow">
            No hay registros de entradas.
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pt-2">
        {{ $entradas->links() }}
    </div>

</div>
@endsection