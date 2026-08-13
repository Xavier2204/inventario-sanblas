@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Nueva Unidad de Medida</h2>
        <a href="{{ route('unidades-medida.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form action="{{ route('unidades-medida.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre (ej. Kilogramo, Litro, Caja) *</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm @error('nombre') border-red-500 @enderror">
            @error('nombre') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Abreviatura (ej. kg, L, cj) *</label>
            <input type="text" name="abreviatura" value="{{ old('abreviatura') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 focus:outline-none text-sm @error('abreviatura') border-red-500 @enderror">
            @error('abreviatura') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 flex justify-end space-x-3">
            <a href="{{ route('unidades-medida.index') }}" class="px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">Guardar Unidad</button>
        </div>
    </form>

</div>
@endsection