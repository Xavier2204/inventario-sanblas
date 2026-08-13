@extends('layouts.shell')

@section('sidebar-subtitulo', 'Administración')
@section('header-titulo', 'Panel de Administración')
@section('header-badge', '🟢 Admin')
@section('badge-letra', 'A')
@section('badge-rol', 'Administrador')


@section('menu')
    <div class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-wider px-3 mb-2">General</div>

    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">📊</span> Dashboard
    </a>
    <a href="{{ route('salidas.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('salidas.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🍳</span> Consumo Diario
    </a>
    <a href="{{ route('entradas.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('entradas.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">📥</span> Stock Recibido
    </a>
    <a href="{{ route('productos.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('productos.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🥩</span> Productos
    </a>

    <div class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-wider px-3 mt-6 mb-2">Ajustes Sistema</div>
    <a href="{{ route('proveedores.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('proveedores.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">🚚</span> Proveedores
    </a>
    <a href="{{ route('usuarios.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('usuarios.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">👥</span> Usuarios
    </a>
    <a href="{{ route('auditoria.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('auditoria.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">⚙️</span> Auditoría
    </a>
    <a href="{{ route('reportes.index') }}" class="flex items-center px-3 py-2.5 text-xs font-bold rounded-lg transition {{ request()->routeIs('reportes.*') ? 'bg-emerald-600 text-white shadow' : 'text-emerald-100/80 hover:bg-emerald-900 hover:text-white' }}">
        <span class="text-base mr-3">📑</span> Reportes
    </a>
@endsection