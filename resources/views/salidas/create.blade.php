@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="formularioSalida()">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Registrar Salida de Insumos</h2>
        <a href="{{ route('salidas.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <!-- MOSTRAR ERRORES DE VALIDACIÓN SI EXISTEN -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-800 p-4 rounded-xl text-sm">
            <strong class="font-bold">Por favor corrige los siguientes errores:</strong>
            <ul class="list-disc list-inside mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('salidas.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Datos Cabecera -->
        <div class="bg-white p-6 rounded-xl shadow border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Motivo / Tipo de Salida *</label>
                <!-- CORREGIDO: name="motivo" y valores acordes al ENUM/Controlador -->
                <select name="motivo" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm bg-white">
                    <option value="">Seleccione un motivo...</option>
                    <option value="Consumo interno" {{ old('motivo') == 'Consumo interno' ? 'selected' : '' }}>Consumo Interno / Cocina</option>
                    <option value="Producción" {{ old('motivo') == 'Producción' ? 'selected' : '' }}>Producción</option>
                    <option value="Venta" {{ old('motivo') == 'Venta' ? 'selected' : '' }}>Venta</option>
                    <option value="Daño" {{ old('motivo') == 'Daño' ? 'selected' : '' }}>Producto Dañado</option>
                    <option value="Caducado" {{ old('motivo') == 'Caducado' ? 'selected' : '' }}>Caducado</option>
                    <option value="Merma" {{ old('motivo') == 'Merma' ? 'selected' : '' }}>Merma</option>
                    <option value="Otro" {{ old('motivo') == 'Otro' ? 'selected' : '' }}>Otro Motivo</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Salida *</label>
                <input type="datetime-local" name="fecha" value="{{ date('Y-m-d\TH:i') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm bg-white">
            </div>
        </div>

        <!-- Detalle de Productos -->
        <div class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-slate-800">Insumos a Descontar</h3>
                <button type="button" @click="agregarFila()" class="px-3 py-1.5 bg-slate-800 text-white rounded-lg text-xs font-semibold hover:bg-slate-700">
                    + Agregar Insumo
                </button>
            </div>

            <div class="space-y-3">
                <template x-for="(item, index) in filas" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center bg-slate-50 p-3 rounded-lg border border-gray-200">
                        <!-- Producto -->
                        <div class="md:col-span-6">
                            <label class="block text-[11px] font-semibold text-gray-500 md:hidden">Producto</label>
                            <!-- CORREGIDO: productos[index][id] -->
                            <select :name="`productos[${index}][id]`" x-model="item.id" required class="w-full px-2 py-1.5 border rounded-lg text-xs focus:ring-1 focus:ring-amber-400 bg-white">
                                <option value="">Seleccionar Producto...</option>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nombre }} (Stock: {{ $p->stock_actual }} {{ $p->unidadMedida->abreviatura ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cantidad -->
                        <div class="md:col-span-5">
                            <label class="block text-[11px] font-semibold text-gray-500 md:hidden">Cantidad A Retirar</label>
                            <!-- CORREGIDO: productos[index][cantidad] -->
                            <input type="number" step="0.01" min="0.01" placeholder="Cantidad" :name="`productos[${index}][cantidad]`" x-model.number="item.cantidad" required class="w-full px-2 py-1.5 border rounded-lg text-xs bg-white">
                        </div>

                        <!-- Eliminar Fila -->
                        <div class="md:col-span-1 text-right">
                            <button type="button" @click="quitarFila(index)" class="text-red-500 hover:text-red-700 font-bold text-sm px-2">
                                ✕
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Observaciones / Justificación</label>
            <!-- CORREGIDO: name="observacion" -->
            <textarea name="observacion" rows="2" placeholder="Detalla el motivo de la salida si es necesario..." class="w-full px-3 py-2 border rounded-lg text-sm bg-white focus:ring-2 focus:ring-amber-400"></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('salidas.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">
                Procesar y Descontar Stock
            </button>
        </div>
    </form>

</div>

<script>
function formularioSalida() {
    return {
        // CORREGIDO: id en lugar de producto_id
        filas: [{ id: '', cantidad: 1 }],
        agregarFila() {
            this.filas.push({ id: '', cantidad: 1 });
        },
        quitarFila(index) {
            if (this.filas.length > 1) {
                this.filas.splice(index, 1);
            }
        }
    }
}
</script>
@endsection