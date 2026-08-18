@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado y Botón Crear -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Salidas de Inventario</h2>
            <p class="text-sm text-gray-500">Registro de egresos de insumos (Uso en cocina, mermas, ajustes)</p>
        </div>
        <a href="{{ route('salidas.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-sm shadow transition">
            + Registrar Salida
        </a>
    </div>

    <!-- Vista Escritorio (Tabla) -->
    <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">N° Salida</th>
                    <th class="p-4">Tipo de Salida</th>
                    <th class="p-4">Fecha</th>
                    <th class="p-4">Registrado por</th>
                    <th class="p-4">Total Aprox.</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($salidas as $s)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 font-bold text-slate-800">
                        {{ 'SAL-' . str_pad($s->id, 5, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="p-4">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">
                            {{ $s->motivo ?? $s->tipo_salida ?? 'Consumo Interno' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-500 text-xs">{{ \Carbon\Carbon::parse($s->fecha)->format('d/m/Y H:i') }}</td>
                    
                    <!-- CORRECCIÓN: Nombre de usuario + Rol -->
                    <td class="p-4 text-gray-600">
                        @if($s->usuario)
                            <span class="font-medium text-slate-700">{{ $s->usuario->nombres }} {{ $s->usuario->apellidos ?? '' }}</span>
                            <span class="block text-xs text-amber-600 font-semibold">({{ $s->usuario->rol->nombre ?? 'Sin Rol' }})</span>
                        @else
                            <span class="text-gray-400 italic">Usuario Sistema</span>
                        @endif
                    </td>

                    <td class="p-4 font-bold text-slate-800">${{ number_format($s->total ?? 0, 2) }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('salidas.show', $s) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-2.5 py-1.5 rounded-md">Ver Detalle</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">No hay registros de salidas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista Móvil (Tarjetas) -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($salidas as $s)
        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 space-y-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs text-gray-400">Registro</span>
                    <h3 class="font-bold text-slate-800 text-base">
                        {{ 'SAL-' . str_pad($s->id, 5, '0', STR_PAD_LEFT) }}
                    </h3>
                </div>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">
                    {{ $s->motivo ?? $s->tipo_salida ?? 'Consumo Interno' }}
                </span>
            </div>

            <div class="text-xs space-y-1 text-gray-600">
                <!-- CORRECCIÓN: Nombre y Rol en vista móvil -->
                <p>👤 <strong>Por:</strong> 
                    @if($s->usuario)
                        {{ $s->usuario->nombres }} <span class="text-amber-600 font-semibold">({{ $s->usuario->rol->nombre ?? 'Sin Rol' }})</span>
                    @else
                        Usuario Sistema
                    @endif
                </p>
                <p>📅 <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($s->fecha)->format('d/m/Y H:i') }}</p>
            </div>

            <div class="pt-2 border-t border-gray-100 flex justify-between items-center">
                <span class="text-base font-bold text-slate-800">${{ number_format($s->total ?? 0, 2) }}</span>
                <a href="{{ route('salidas.show', $s) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1.5 rounded-md font-semibold">Ver Detalle</a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-400 shadow">
            No hay registros de salidas.
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pt-2">
        {{ $salidas->links() }}
    </div>

</div>
@endsection