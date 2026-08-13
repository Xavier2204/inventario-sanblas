<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    /**
     * Página principal de reportes (índice/menú).
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Consulta compartida: productos con stock_actual <= stock_minimo
     */
    private function productosStockBajo()
    {
        return Producto::with(['categoria', 'unidadMedida'])
            ->whereColumn('stock_actual', '<=', 'stock_minimo')
            ->where('estado', 'Activo')
            ->orderBy('stock_actual')
            ->get();
    }

    /**
     * Ver el reporte de stock bajo en pantalla.
     */
    public function stockBajo()
    {
        $productos = $this->productosStockBajo();

        return view('reportes.stock-bajo', compact('productos'));
    }

    /**
     * Descargar el reporte de stock bajo en PDF.
     */
    public function stockBajoPdf()
    {
        $productos = $this->productosStockBajo();
        $fecha = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('reportes.pdf.stock-bajo', compact('productos', 'fecha'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('reporte-stock-bajo-' . now()->format('Y-m-d') . '.pdf');
    }
}