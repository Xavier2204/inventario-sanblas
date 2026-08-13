<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 11px; color: #1e293b; }
        h1 { font-size: 16px; margin-bottom: 2px; }
        p.subtitulo { font-size: 10px; color: #64748b; margin-top: 0; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f1f5f9; text-align: left; padding: 6px 8px; font-size: 9px; text-transform: uppercase; color: #475569; border-bottom: 1px solid #cbd5e1; }
        td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; }
        .stock-bajo { color: #b91c1c; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { margin-top: 20px; font-size: 9px; color: #94a3b8; }
    </style>
</head>
<body>

    <h1>San Blas — Reporte de Productos con Stock Bajo</h1>
    <p class="subtitulo">Generado el {{ $fecha }} · {{ $productos->count() }} producto(s) encontrados</p>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th class="text-right">Stock Actual</th>
                <th class="text-right">Stock Mínimo</th>
                <th>Unidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre ?? '—' }}</td>
                    <td class="text-right stock-bajo">{{ number_format($producto->stock_actual, 2) }}</td>
                    <td class="text-right">{{ number_format($producto->stock_minimo, 2) }}</td>
                    <td>{{ $producto->unidadMedida->abreviatura ?? '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="6">No hay productos con stock bajo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Sistema de Inventario San Blas — Documento generado automáticamente</p>

</body>
</html>