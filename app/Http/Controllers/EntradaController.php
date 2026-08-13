<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\DetalleEntrada;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with(['proveedor', 'usuario'])
            ->latest('id')
            ->paginate(10);

        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        $productos   = Producto::where('estado', 'Activo')->get();

        return view('entradas.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id'         => 'required|exists:proveedores,id',
            'numero_factura'       => 'nullable|string|max:50',
            'fecha'                => 'nullable|date',
            'observacion'          => 'nullable|string',
            'productos'            => 'required|array|min:1',
            'productos.*.id'       => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|gt:0',
            'productos.*.precio'   => 'required|numeric|gte:0',
        ]);

        DB::transaction(function () use ($request) {
            $totalEntrada = 0;

            // 1. Crear el registro principal de la Entrada
            $entrada = Entrada::create([
                'usuario_id'     => Auth::user()->id, // FIX 1: Forzar extracción del ID numérico
                'proveedor_id'   => $request->proveedor_id,
                'fecha'          => $request->fecha ?? now(), // FIX 2: Usar la fecha elegida en el formulario
                'numero_factura' => $request->numero_factura,
                'observacion'    => $request->observacion,
                'total'          => 0,
            ]);

            // 2. Procesar cada producto ingresado
            foreach ($request->productos as $item) {
                $subtotal = $item['cantidad'] * $item['precio'];
                $totalEntrada += $subtotal;

                // Crear detalle
                DetalleEntrada::create([
                    'entrada_id'  => $entrada->id,
                    'producto_id' => $item['id'],
                    'cantidad'    => $item['cantidad'],
                    'precio'      => $item['precio'],
                    'subtotal'    => $subtotal,
                ]);

                // Aumentar el stock actual del producto
                $producto = Producto::findOrFail($item['id']);
                $producto->increment('stock_actual', $item['cantidad']);

                // Actualizar precio de compra del producto si cambió
                $producto->update(['precio_compra' => $item['precio']]);
            }

            // 3. Actualizar el total de la entrada
            $entrada->update(['total' => $totalEntrada]);
        });

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada de inventario registrada con éxito.');
    }

    public function show(Entrada $entrada)
    {
        $entrada->load(['proveedor', 'usuario', 'detalles.producto']);
        return view('entradas.show', compact('entrada'));
    }
}