<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\DetalleSalida;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::with(['usuario'])->latest('id')->paginate(10);
        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        $productos = Producto::where('estado', 'Activo')->where('stock_actual', '>', 0)->get();
        return view('salidas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motivo'         => 'required|in:Venta,Producción,Daño,Caducado,Merma,Consumo interno,Otro',
            'observacion'    => 'nullable|string',
            'productos'      => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|gt:0',
        ]);

        // Validar primero si hay stock suficiente para todos los productos requeridos
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['id']);
            if ($producto->stock_actual < $item['cantidad']) {
                return back()->withErrors([
                    'stock' => "El producto {$producto->nombre} no tiene suficiente stock. Disponible: {$producto->stock_actual}."
                ])->withInput();
            }
        }

        DB::transaction(function () use ($request) {
            // CORRECCIÓN 1: Obtener explícitamente la columna 'id' del usuario autenticado
            $usuarioId = Auth::user()->id;

            // 1. Crear la Salida
            $salida = Salida::create([
                'usuario_id'  => $usuarioId,
                'fecha'       => now(),
                'motivo'      => $request->motivo,
                'observacion' => $request->observacion,
            ]);

            // 2. Procesar detalles y descontar stock
            foreach ($request->productos as $item) {
                $producto = Producto::findOrFail($item['id']);
                
                // CORRECCIÓN 2: Controlar que el precio nunca viaje como NULL
                $precioUnitario = $producto->precio_venta ?? 0;
                $subtotal = $item['cantidad'] * $precioUnitario;

                DetalleSalida::create([
                    'salida_id'       => $salida->id,
                    'producto_id'     => $producto->id,
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $precioUnitario,
                    'subtotal'        => $subtotal,
                ]);

                // Disminuir stock
                $producto->decrement('stock_actual', $item['cantidad']);
            }
        });

        return redirect()->route('salidas.index')
            ->with('success', 'Salida de inventario registrada con éxito.');
    }

    public function show(Salida $salida)
    {
        $salida->load(['usuario', 'detalles.producto']);
        return view('salidas.show', compact('salida'));
    }
}