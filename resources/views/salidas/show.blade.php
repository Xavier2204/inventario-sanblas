@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Salida #{{ 'SAL-' . str_pad($salida->id, 5, '0', STR_PAD_LEFT) }}
            </h2>
            <p class="text-sm text-gray-500">Registrada el {{ \Carbon\Carbon::parse($salida->fecha)->format('d/m/Y H:i') }}</p>
        </div>
        <a href="{{ route('salidas.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <!-- Ficha de Datos Generales -->
    <div class="bg-white p-6 rounded-xl shadow border border-gray-100 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
        <div>
            <span class="text-gray-400 block text-xs">Tipo de Salida:</span>
            <span class="font-bold text-slate-800">{{ $salida->tipo_salida ?? 'Consumo Interno' }}</span>
        </div>
        <div>
            <span class="text-gray-400 block text-xs">Registrado por:</span>
            <span class="font-bold text-slate-800">{{ $salida->usuario->name ?? 'Usuario Sistema' }}</span>
        </div>
        <div>
            <span class="text-gray-400 block text-xs">Valor Estimado:</span>
            <span class="font-bold text-slate-800">${{ number_format($salida->total, 2) }}</span>
        </div>
    </div>

    <!-- Tabla Detalle -->
    <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-gray-100 font-bold text-slate-800 text-sm">
            Insumos Retirados
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b text-xs text-gray-500 uppercase">
                <tr>
                    <th class="p-4">Producto</th>
                    <th class="p-4 text-center">Cantidad Retirada</th>
                    <th class="p-4 text-right">P. Unitario Ref.</th>
                    <th class="p-4 text-right">Subtotal Ref.</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($salida->detalles as $det)
                <tr>
                    <td class="p-4 font-semibold text-slate-800">{{ $det->producto->nombre ?? 'Producto Eliminado' }}</td>
                    <td class="p-4 text-center font-bold text-red-600">-{{ number_format($det->cantidad, 2) }} {{ $det->producto->unidadMedida->abreviatura ?? '' }}</td>
                    <td class="p-4 text-right">${{ number_format($det->precio_unitario, 2) }}</td>
                    <td class="p-4 text-right font-bold text-slate-800">${{ number_format($det->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-slate-50 font-bold text-slate-800 border-t">
                <tr>
                    <td colspan="3" class="p-4 text-right">Total Valor Impactado:</td>
                    <td class="p-4 text-right text-lg text-slate-900">${{ number_format($salida->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($salida->observaciones)
    <div class="bg-white p-4 rounded-xl shadow border border-gray-100 text-xs">
        <span class="font-bold text-gray-500 block mb-1">Observaciones / Justificación:</span>
        <p class="text-gray-700">{{ $salida->observaciones }}</p>
    </div>
    @endif

</div>
@endsection