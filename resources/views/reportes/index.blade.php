@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="pb-3 border-b border-slate-200">
        <h1 class="text-2xl font-bold text-slate-800">Reportes</h1>
        <p class="text-xs text-slate-500">Genera reportes operativos del sistema</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-3">
                ⚠️
            </div>
            <h3 class="font-bold text-sm text-slate-800 mb-1">Productos con Stock Bajo</h3>
            <p class="text-xs text-slate-500 mb-4">Lista de insumos que están en o por debajo de su stock mínimo.</p>
            <div class="flex gap-2">
                <a href="{{ route('reportes.stock-bajo') }}" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3 py-2 rounded-lg transition">
                    Ver en pantalla
                </a>
                <a href="{{ route('reportes.stock-bajo.pdf') }}" class="flex-1 text-center bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-2 rounded-lg transition">
                    Descargar PDF
                </a>
            </div>
        </div>

    </div>

</div>
@endsection