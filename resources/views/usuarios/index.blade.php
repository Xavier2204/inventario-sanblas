@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Encabezado y Acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Gestión de Usuarios</h2>
            <p class="text-sm text-gray-500">Administra el personal del restaurante y sus niveles de acceso</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-sm shadow transition">
            + Nuevo Usuario
        </a>
    </div>

    <!-- Vista Escritorio (Tabla) -->
    <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="p-4">Usuario</th>
                    <th class="p-4">Correo Electrónico</th>
                    <th class="p-4">Rol / Permisos</th>
                    <th class="p-4 text-center">Estado</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($usuarios as $u)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 font-semibold text-slate-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-full bg-slate-800 text-amber-400 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr($u->usuario, 0, 1)) }}
                            </div>
                            <span>{{ $u->usuario }}</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">{{ $u->correo }}</td>
                    <td class="p-4">
                        @if(($u->rol->nombre ?? '') == 'Administrador')
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                👑 {{ $u->rol->nombre }}
                            </span>
                        @else
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                👨‍🍳 {{ $u->rol->nombre ?? 'Sin Rol' }}
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        @if($u->estado == 'Activo')
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Activo</span>
                        @else
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                        @endif
                    </td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('usuarios.edit', $u) }}" class="text-amber-600 hover:text-amber-800 text-xs font-medium bg-amber-50 px-2.5 py-1.5 rounded-md">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista Móvil (Tarjetas) -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($usuarios as $u)
        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-slate-800 text-amber-400 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr($u->usuario, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-base">{{ $u->usuario }}</h3>
                        <p class="text-xs text-gray-500">{{ $u->correo }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center pt-2 border-t border-gray-100 text-xs">
                <div>
                    <span class="text-gray-400">Rol:</span>
                    <strong class="text-slate-700">{{ $u->rol->nombre ?? 'Sin Rol' }}</strong>
                </div>
                <div>
                    @if($u->estado == 'Activo')
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Activo</span>
                    @else
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                    @endif
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <a href="{{ route('usuarios.edit', $u) }}" class="text-xs bg-amber-50 text-amber-600 px-3 py-1.5 rounded-md font-semibold">Editar Usuario</a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-400 shadow">
            No hay usuarios registrados.
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pt-2">
        {{ $usuarios->links() }}
    </div>

</div>
@endsection