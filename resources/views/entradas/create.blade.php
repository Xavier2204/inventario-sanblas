@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="formularioEntrada()">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Registrar Entrada de Insumos</h2>
        <a href="{{ route('entradas.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    {{-- Alerta de errores de validación para depuración --}}
    @if ($errors->any())
        <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
            <p class="font-bold">Revisa los siguientes campos:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('entradas.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Datos Cabecera -->
        <div class="bg-white p-6 rounded-xl shadow border border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Proveedor *</label>
                <select name="proveedor_id" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
                    <option value="">Seleccione Proveedor</option>
                    @foreach($proveedores as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->empresa }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">N° Comprobante / Factura</label>
                <!-- CORREGIDO: numero_factura -->
                <input type="text" name="numero_factura" placeholder="Ej: F-00123" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Entrada *</label>
                <input type="datetime-local" name="fecha" value="{{ date('Y-m-d\TH:i') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-amber-400 text-sm">
            </div>
        </div>

        <!-- Detalle de Productos -->
        <div class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-slate-800">Detalle de Insumos</h3>
                <button type="button" @click="agregarFila()" class="px-3 py-1.5 bg-slate-800 text-white rounded-lg text-xs font-semibold hover:bg-slate-700">
                    + Agregar Insumo
                </button>
            </div>

            <div class="space-y-3">
                <template x-for="(item, index) in filas" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center bg-slate-50 p-3 rounded-lg border border-gray-200">
                        <!-- Producto (CORREGIDO: productos[index][id]) -->
                        <div class="md:col-span-5">
                            <label class="block text-[11px] font-semibold text-gray-500 md:hidden">Producto</label>
                            <select :name="`productos[${index}][id]`" x-model="item.id" required class="w-full px-2 py-1.5 border rounded-lg text-xs focus:ring-1 focus:ring-amber-400 bg-white">
                                <option value="">Seleccionar Producto...</option>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id }}">{{ $p->nombre }} ({{ $p->unidadMedida->abreviatura ?? '' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cantidad (CORREGIDO: productos[index][cantidad]) -->
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-semibold text-gray-500 md:hidden">Cantidad</label>
                            <input type="number" step="0.01" min="0.01" placeholder="Cant." :name="`productos[${index}][cantidad]`" x-model.number="item.cantidad" required class="w-full px-2 py-1.5 border rounded-lg text-xs bg-white">
                        </div>

                        <!-- Precio Costo (CORREGIDO: productos[index][precio]) -->
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-semibold text-gray-500 md:hidden">P. Unitario ($)</label>
                            <input type="number" step="0.01" min="0" placeholder="P. Unit" :name="`productos[${index}][precio]`" x-model.number="item.precio" required class="w-full px-2 py-1.5 border rounded-lg text-xs bg-white">
                        </div>

                        <!-- Subtotal -->
                        <div class="md:col-span-2 text-right font-semibold text-slate-700 text-xs py-1">
                            $<span x-text="(item.cantidad * item.precio || 0).toFixed(2)"></span>
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

            <!-- Total General -->
            <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                <span class="text-base font-bold text-slate-800">Total General:</span>
                <span class="text-2xl font-extrabold text-slate-900">$<span x-text="calcularTotal().toFixed(2)"></span></span>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Observaciones / Notas</label>
            <!-- CORREGIDO: observacion -->
            <textarea name="observacion" rows="2" class="w-full px-3 py-2 border rounded-lg text-sm bg-white focus:ring-2 focus:ring-amber-400"></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('entradas.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow">
                Guardar y Procesar Entrada
            </button>
        </div>
    </form>

</div>

<script>
function formularioEntrada() {
    return {
        filas: [{ id: '', cantidad: 1, precio: 0 }],
        agregarFila() {
            this.filas.push({ id: '', cantidad: 1, precio: 0 });
        },
        quitarFila(index) {
            if (this.filas.length > 1) {
                this.filas.splice(index, 1);
            }
        },
        calcularTotal() {
            return this.filas.reduce((total, f) => total + (f.cantidad * f.precio || 0), 0);
        }
    }
}
</script>
@endsection