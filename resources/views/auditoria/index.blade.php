@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Auditoría del Sistema</h1>
            <p class="text-xs text-slate-500">Bitácora de acciones realizadas por los usuarios</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Fecha</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Usuario</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Acción</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Tabla Afectada</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Detalles</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($auditorias as $registro)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-600">{{ $registro->fecha->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">
                            {{ $registro->usuario->usuario ?? 'Sistema' }}
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $registro->accion }}</td>
                        <td class="px-4 py-3">
                            <span class="bg-slate-100 text-slate-700 text-xs font-bold px-2 py-1 rounded">
                                {{ $registro->tabla_afectada }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-xs">{{ $registro->detalles ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-400">
                            No hay registros de auditoría todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $auditorias->links() }}
    </div>

</div>
@endsection