@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado y Botón Crear -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Categorías de Insumos</h2>
            <p class="text-sm text-gray-500">Administra las familias de productos de San Blas</p>
        </div>
        <a href="{{ route('categorias.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-sm shadow transition">
            + Nueva Categoría
        </a>
    </div>

    <!-- Vista Escritorio (Tabla) -->
    <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Nombre</th>
                    <th class="p-4">Descripción</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($categorias as $cat)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 text-gray-500">{{ $cat->id }}</td>
                    <td class="p-4 font-semibold text-slate-800">{{ $cat->nombre }}</td>
                    <td class="p-4 text-gray-600">{{ $cat->descripcion ?? 'Sin descripción' }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full {{ $cat->estado === 'Activo' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                            {{ $cat->estado }}
                        </span>
                    </td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('categorias.edit', $cat) }}" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">No hay categorías registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista Móvil (Tarjetas) -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($categorias as $cat)
        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 space-y-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs text-gray-400">#{{ $cat->id }}</span>
                    <h3 class="font-bold text-slate-800 text-lg">{{ $cat->nombre }}</h3>
                </div>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $cat->estado === 'Activo' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                    {{ $cat->estado }}
                </span>
            </div>
            <p class="text-xs text-gray-600">{{ $cat->descripcion ?? 'Sin descripción' }}</p>
            <div class="pt-2 border-t border-gray-100 flex justify-end">
                <a href="{{ route('categorias.edit', $cat) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1.5 rounded-md font-semibold">Editar</a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-400 shadow">
            No hay categorías registradas.
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pt-2">
        {{ $categorias->links() }}
    </div>

</div>
@endsection