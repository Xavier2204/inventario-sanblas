@extends('layouts.shell')

@section('sidebar-subtitulo', 'Módulo Bodega')
@section('header-titulo', 'Módulo de Bodega')
@section('header-badge', '🟢 Bodeguero')
@section('badge-letra', 'B')
@section('badge-rol', 'Bodeguero')

@section('menu')
    <div class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-wider px-3 mb-2">Gestión de Stock</div>

    <a href="{{ route('entradas.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('entradas.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">📥</span> Stock Recibido
    </a>
    <a href="{{ route('productos.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('productos.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🥩</span> Lista de Productos
    </a>
    <a href="{{ route('categorias.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('categorias.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🏷️</span> Categorías
    </a>
    <a href="{{ route('unidades-medida.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('unidades-medida.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">📏</span> Unidades de Medida
    </a>
@endsection