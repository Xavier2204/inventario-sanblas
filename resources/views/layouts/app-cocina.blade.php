@extends('layouts.shell')

@section('sidebar-subtitulo', 'Módulo Cocina')
@section('header-titulo', 'Módulo de Cocina')
@section('header-badge', '🟢 Cocina')
@section('badge-letra', 'C')
@section('badge-rol', 'Cocina')

@section('menu')
    <div class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-wider px-3 mb-2">Operaciones</div>

    <a href="{{ route('salidas.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('salidas.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🍳</span> Consumo Diario
    </a>
    <a href="{{ route('productos.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('productos.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🥩</span> Consulta de Stock
    </a>
@endsection