@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Sistema Web de Inventarios</h1>
            <p class="text-xs text-slate-500">Resumen operativo general de Restaurante San Blas</p>
        </div>
        <a href="{{ route('productos.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2.5 rounded-lg shadow transition">
            + Nuevo Producto
        </a>
    </div>

    <!-- TARJETAS EN GRID DE 4 COLUMNAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1: Órdenes de Compra -->
        <a href="{{ route('entradas.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-emerald-600 flex items-center justify-center text-2xl shrink-0">
                🛒
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Órdenes de Compra</h3>
                    <p class="text-[10px] text-slate-400">Entradas de insumos</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">4</span>
            </div>
        </a>

        <!-- Card 2: Stock Recibido -->
        <a href="{{ route('entradas.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-teal-600 flex items-center justify-center text-2xl shrink-0">
                📦
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Stock Recibido</h3>
                    <p class="text-[10px] text-slate-400">Almacén general</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">3</span>
            </div>
        </a>

        <!-- Card 3: Devoluciones / Mermas -->
        <a href="{{ route('salidas.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-amber-500 flex items-center justify-center text-2xl shrink-0">
                ↩️
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Devoluciones</h3>
                    <p class="text-[10px] text-slate-400">Ajustes y mermas</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">2</span>
            </div>
        </a>

        <!-- Card 4: Consumo Diario -->
        <a href="{{ route('salidas.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-blue-600 flex items-center justify-center text-2xl shrink-0">
                📄
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Consumo Diario</h3>
                    <p class="text-[10px] text-slate-400">Órdenes de cocina</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">12</span>
            </div>
        </a>

        <!-- Card 5: Proveedores -->
        <a href="{{ route('proveedores.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-orange-500 flex items-center justify-center text-2xl shrink-0">
                🚚
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Proveedores</h3>
                    <p class="text-[10px] text-slate-400">Catálogo activo</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">1</span>
            </div>
        </a>

        <!-- Card 6: Productos -->
        <a href="{{ route('productos.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-indigo-600 flex items-center justify-center text-2xl shrink-0">
                🥩
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Productos</h3>
                    <p class="text-[10px] text-slate-400">Insumos registrados</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">3</span>
            </div>
        </a>

        <!-- Card 7: Usuarios -->
        <a href="{{ route('usuarios.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-pink-600 flex items-center justify-center text-2xl shrink-0">
                👥
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Usuarios</h3>
                    <p class="text-[10px] text-slate-400">Acceso al sistema</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">1</span>
            </div>
        </a>

        <!-- Card 8: Auditoría -->
        <a href="{{ route('auditoria.index') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition flex items-center overflow-hidden h-20 group">
            <div class="w-16 h-20 bg-slate-700 flex items-center justify-center text-2xl shrink-0">
                ⚙️
            </div>
            <div class="p-3 flex-1 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xs text-slate-800">Auditoría</h3>
                    <p class="text-[10px] text-slate-400">Bitácora de cambios</p>
                </div>
                <span class="text-lg font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">OK</span>
            </div>
        </a>

    </div>

</div>
@endsection