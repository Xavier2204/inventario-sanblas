<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra el listado de productos con búsqueda y relaciones cargadas.
     */
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'unidadMedida']);

        // Filtro rápido por nombre o código si el usuario busca algo en la vista
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('codigo', 'like', "%{$search}%");
            });
        }

        $productos = $query->latest('id')->paginate(12);

        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        // Traemos solo categorías activas para asignar
        $categorias = Categoria::where('estado', 'Activo')->get();
        $unidades = UnidadMedida::all();

        return view('productos.create', compact('categorias', 'unidades'));
    }

    /**
     * Almacena un producto recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id'     => 'required|exists:categorias,id',
            'unidad_medida_id' => 'required|exists:unidades_medida,id',
            'codigo'           => 'nullable|string|max:50|unique:productos,codigo',
            'nombre'           => 'required|string|max:150',
            'descripcion'      => 'nullable|string',
            'stock_actual'     => 'required|numeric|min:0',
            'stock_minimo'     => 'required|numeric|min:0',
            'precio_compra'    => 'nullable|numeric|min:0',
            'precio_venta'     => 'nullable|numeric|min:0',
            'estado'           => 'required|in:Activo,Inactivo',
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado exitosamente.');
    }

    /**
     * Muestra el detalle completo de un producto (útil para revisar kárdex o estado).
     */
    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'unidadMedida']);
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('estado', 'Activo')->get();
        $unidades = UnidadMedida::all();

        return view('productos.edit', compact('producto', 'categorias', 'unidades'));
    }

    /**
     * Actualiza la información del producto.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'categoria_id'     => 'required|exists:categorias,id',
            'unidad_medida_id' => 'required|exists:unidades_medida,id',
            'codigo'           => 'nullable|string|max:50|unique:productos,codigo,' . $producto->id,
            'nombre'           => 'required|string|max:150',
            'descripcion'      => 'nullable|string',
            'stock_actual'     => 'required|numeric|min:0',
            'stock_minimo'     => 'required|numeric|min:0',
            'precio_compra'    => 'nullable|numeric|min:0',
            'precio_venta'     => 'nullable|numeric|min:0',
            'estado'           => 'required|in:Activo,Inactivo',
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Cambia el estado del producto a Inactivo en lugar de destruirlo físicamente.
     */
    public function destroy(Producto $producto)
    {
        $producto->update(['estado' => 'Inactivo']);

        return redirect()->route('productos.index')
            ->with('success', 'Producto marcado como inactivo.');
    }
}