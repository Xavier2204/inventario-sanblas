<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Limpiar todo antes de sembrar (por si vienes de datos previos)
        DB::table('detalle_entradas')->truncate();
        DB::table('entradas')->truncate();
        DB::table('detalle_salidas')->truncate();
        DB::table('salidas')->truncate();
        DB::table('productos')->truncate();
        DB::table('proveedores')->truncate();
        DB::table('unidades_medida')->truncate();
        DB::table('categorias')->truncate();
        Usuario::truncate();
        DB::table('roles')->truncate();

        // ================= 1. ROLES =================
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Administrador', 'descripcion' => 'Acceso total al sistema'],
            ['id' => 2, 'nombre' => 'Cocinero / Chef', 'descripcion' => 'Gestión de insumos y salidas de cocina'],
            ['id' => 3, 'nombre' => 'Bodeguero', 'descripcion' => 'Registro de entradas y control de stock'],
        ]);

        // ================= 2. USUARIOS =================
        Usuario::create([
            'rol_id' => 1, 'nombres' => 'Administrador', 'apellidos' => 'Sistema',
            'correo' => 'admin@sanblas.com', 'usuario' => 'admin',
            'password' => Hash::make('admin123'), 'estado' => 'Activo',
        ]);

        Usuario::create([
            'rol_id' => 2, 'nombres' => 'Carlos', 'apellidos' => 'Mendoza',
            'correo' => 'chef@sanblas.com', 'usuario' => 'chef',
            'password' => Hash::make('12345678'), 'estado' => 'Activo',
        ]);

        Usuario::create([
            'rol_id' => 3, 'nombres' => 'Ana', 'apellidos' => 'Gómez',
            'correo' => 'bodega@sanblas.com', 'usuario' => 'bodega',
            'password' => Hash::make('12345678'), 'estado' => 'Activo',
        ]);

        // ================= 3. CATEGORÍAS =================
        DB::table('categorias')->insert([
            ['id' => 1, 'nombre' => 'Carnes & Proteínas', 'descripcion' => 'Cortes de res, cerdo, aves y mariscos', 'estado' => 'Activo'],
            ['id' => 2, 'nombre' => 'Abarrotes & Especias', 'descripcion' => 'Aceites, granos, harinas, salsas y condimentos', 'estado' => 'Activo'],
            ['id' => 3, 'nombre' => 'Verduras & Hortalizas', 'descripcion' => 'Vegetales frescos de cocina', 'estado' => 'Activo'],
            ['id' => 4, 'nombre' => 'Lácteos & Huevos', 'descripcion' => 'Quesos, leche, crema y huevos', 'estado' => 'Activo'],
            ['id' => 5, 'nombre' => 'Desechables & Embalaje', 'descripcion' => 'Envases, plásticos, servilletas y empaques', 'estado' => 'Activo'],
        ]);

        // ================= 4. UNIDADES DE MEDIDA =================
        DB::table('unidades_medida')->insert([
            ['id' => 1, 'nombre' => 'Kilogramo', 'abreviatura' => 'kg'],
            ['id' => 2, 'nombre' => 'Gramo', 'abreviatura' => 'g'],
            ['id' => 3, 'nombre' => 'Litro', 'abreviatura' => 'L'],
            ['id' => 4, 'nombre' => 'Unidad / Pieza', 'abreviatura' => 'und'],
            ['id' => 5, 'nombre' => 'Caja / Paquete', 'abreviatura' => 'cja'],
        ]);

        // ================= 5. PROVEEDORES =================
        DB::table('proveedores')->insert([
            ['id' => 1, 'empresa' => 'PRONACA S.A.', 'nombre_contacto' => 'Juan Pérez', 'telefono' => '0991234567', 'correo' => 'ventas@pronaca.com', 'direccion' => 'Av. Panamericana Norte Km 7', 'estado' => 'Activo'],
            ['id' => 2, 'empresa' => 'LA PRESTANCIA S.A.', 'nombre_contacto' => 'María Delgado', 'telefono' => '0987654321', 'correo' => 'pedidos@laprestancia.com', 'direccion' => 'Calle Comercial #45, Quito', 'estado' => 'Activo'],
            ['id' => 3, 'empresa' => 'PLÁSTICOS S.A.', 'nombre_contacto' => 'Roberto Gómez', 'telefono' => '0998887766', 'correo' => 'ventas@plasticossa.com', 'direccion' => 'Zona Industrial Lote 12', 'estado' => 'Activo'],
            ['id' => 4, 'empresa' => 'ZUU LÁCTEOS', 'nombre_contacto' => 'Patricia Vaca', 'telefono' => '0995551122', 'correo' => 'ventas@zuulacteos.com', 'direccion' => 'Vía a Cayambe Km 3', 'estado' => 'Activo'],
            ['id' => 5, 'empresa' => 'ECUAVEGETAL', 'nombre_contacto' => 'Luis Toapanta', 'telefono' => '0992223344', 'correo' => 'contacto@ecuavegetal.com', 'direccion' => 'Mercado Mayorista, Ambato', 'estado' => 'Activo'],
        ]);

        // ================= 6. PRODUCTOS (50) =================
        // categoria_id: 1 Carnes | 2 Abarrotes | 3 Verduras | 4 Lácteos | 5 Desechables
        // unidad_id:    1 kg     | 2 g         | 3 L        | 4 und     | 5 cja
        // proveedor_id: 1 Pronaca | 2 La Prestancia | 3 Plásticos S.A. | 4 Zuu Lácteos | 5 Ecuavegetal
        $productos = [
            // --- Carnes & Proteínas (Pronaca) ---
            ['codigo'=>'PROD-001','nombre'=>'Pechuga de Pollo Deshuesada','cantidad'=>25,'precio'=>3.20,'min'=>5,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-002','nombre'=>'Muslo de Pollo','cantidad'=>20,'precio'=>2.50,'min'=>5,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-003','nombre'=>'Alas de Pollo','cantidad'=>15,'precio'=>2.20,'min'=>4,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-004','nombre'=>'Carne Molida de Res','cantidad'=>18,'precio'=>4.80,'min'=>4,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-005','nombre'=>'Lomo Fino de Res','cantidad'=>10,'precio'=>7.50,'min'=>2,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-006','nombre'=>'Costilla de Cerdo','cantidad'=>15,'precio'=>4.20,'min'=>3,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-007','nombre'=>'Chuleta de Cerdo','cantidad'=>12,'precio'=>4.00,'min'=>3,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-008','nombre'=>'Chorizo Criollo','cantidad'=>10,'precio'=>3.80,'min'=>2,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-009','nombre'=>'Salchicha Frankfurt','cantidad'=>12,'precio'=>3.50,'min'=>3,'cat'=>1,'uni'=>1,'prov'=>1],
            ['codigo'=>'PROD-010','nombre'=>'Filete de Tilapia','cantidad'=>8,'precio'=>5.20,'min'=>2,'cat'=>1,'uni'=>1,'prov'=>1],

            // --- Abarrotes & Especias (La Prestancia) ---
            ['codigo'=>'PROD-011','nombre'=>'Aceite Vegetal Girasol','cantidad'=>30,'precio'=>2.30,'min'=>6,'cat'=>2,'uni'=>3,'prov'=>2],
            ['codigo'=>'PROD-012','nombre'=>'Arroz Extra','cantidad'=>50,'precio'=>0.95,'min'=>10,'cat'=>2,'uni'=>1,'prov'=>2],
            ['codigo'=>'PROD-013','nombre'=>'Azúcar Blanca','cantidad'=>40,'precio'=>0.85,'min'=>8,'cat'=>2,'uni'=>1,'prov'=>2],
            ['codigo'=>'PROD-014','nombre'=>'Sal Refinada','cantidad'=>20,'precio'=>0.55,'min'=>5,'cat'=>2,'uni'=>1,'prov'=>2],
            ['codigo'=>'PROD-015','nombre'=>'Harina de Trigo','cantidad'=>35,'precio'=>1.10,'min'=>7,'cat'=>2,'uni'=>1,'prov'=>2],
            ['codigo'=>'PROD-016','nombre'=>'Fideo Spaghetti','cantidad'=>25,'precio'=>1.40,'min'=>5,'cat'=>2,'uni'=>1,'prov'=>2],
            ['codigo'=>'PROD-017','nombre'=>'Salsa de Tomate','cantidad'=>20,'precio'=>2.80,'min'=>4,'cat'=>2,'uni'=>3,'prov'=>2],
            ['codigo'=>'PROD-018','nombre'=>'Mayonesa','cantidad'=>15,'precio'=>3.20,'min'=>3,'cat'=>2,'uni'=>3,'prov'=>2],
            ['codigo'=>'PROD-019','nombre'=>'Vinagre Blanco','cantidad'=>10,'precio'=>1.60,'min'=>2,'cat'=>2,'uni'=>3,'prov'=>2],
            ['codigo'=>'PROD-020','nombre'=>'Comino Molido','cantidad'=>5,'precio'=>6.50,'min'=>1,'cat'=>2,'uni'=>1,'prov'=>2],

            // --- Verduras & Hortalizas (Ecuavegetal) ---
            ['codigo'=>'PROD-021','nombre'=>'Tomate Riñón','cantidad'=>30,'precio'=>1.20,'min'=>6,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-022','nombre'=>'Cebolla Paiteña','cantidad'=>25,'precio'=>0.90,'min'=>5,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-023','nombre'=>'Papa Chola','cantidad'=>40,'precio'=>0.60,'min'=>8,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-024','nombre'=>'Zanahoria','cantidad'=>20,'precio'=>0.70,'min'=>4,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-025','nombre'=>'Lechuga Crespa','cantidad'=>30,'precio'=>0.50,'min'=>6,'cat'=>3,'uni'=>4,'prov'=>5],
            ['codigo'=>'PROD-026','nombre'=>'Pimiento Verde','cantidad'=>15,'precio'=>1.50,'min'=>3,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-027','nombre'=>'Brócoli','cantidad'=>12,'precio'=>1.80,'min'=>3,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-028','nombre'=>'Cilantro','cantidad'=>20,'precio'=>0.30,'min'=>4,'cat'=>3,'uni'=>4,'prov'=>5],
            ['codigo'=>'PROD-029','nombre'=>'Ajo','cantidad'=>8,'precio'=>3.50,'min'=>2,'cat'=>3,'uni'=>1,'prov'=>5],
            ['codigo'=>'PROD-030','nombre'=>'Limón Sutil','cantidad'=>15,'precio'=>1.00,'min'=>3,'cat'=>3,'uni'=>1,'prov'=>5],

            // --- Lácteos & Huevos (Zuu Lácteos) ---
            ['codigo'=>'PROD-031','nombre'=>'Leche Entera','cantidad'=>40,'precio'=>0.95,'min'=>8,'cat'=>4,'uni'=>3,'prov'=>4],
            ['codigo'=>'PROD-032','nombre'=>'Queso Mozzarella','cantidad'=>15,'precio'=>6.80,'min'=>3,'cat'=>4,'uni'=>1,'prov'=>4],
            ['codigo'=>'PROD-033','nombre'=>'Queso Fresco','cantidad'=>12,'precio'=>4.50,'min'=>3,'cat'=>4,'uni'=>1,'prov'=>4],
            ['codigo'=>'PROD-034','nombre'=>'Mantequilla','cantidad'=>8,'precio'=>5.20,'min'=>2,'cat'=>4,'uni'=>1,'prov'=>4],
            ['codigo'=>'PROD-035','nombre'=>'Crema de Leche','cantidad'=>20,'precio'=>3.80,'min'=>4,'cat'=>4,'uni'=>3,'prov'=>4],
            ['codigo'=>'PROD-036','nombre'=>'Yogurt Natural','cantidad'=>15,'precio'=>2.50,'min'=>3,'cat'=>4,'uni'=>3,'prov'=>4],
            ['codigo'=>'PROD-037','nombre'=>'Huevos (Cubeta x30)','cantidad'=>20,'precio'=>4.20,'min'=>4,'cat'=>4,'uni'=>5,'prov'=>4],
            ['codigo'=>'PROD-038','nombre'=>'Queso Parmesano','cantidad'=>5,'precio'=>9.50,'min'=>1,'cat'=>4,'uni'=>1,'prov'=>4],
            ['codigo'=>'PROD-039','nombre'=>'Requesón','cantidad'=>10,'precio'=>3.60,'min'=>2,'cat'=>4,'uni'=>1,'prov'=>4],
            ['codigo'=>'PROD-040','nombre'=>'Leche Condensada','cantidad'=>12,'precio'=>3.20,'min'=>3,'cat'=>4,'uni'=>3,'prov'=>4],

            // --- Desechables & Embalaje (Plásticos S.A.) ---
            ['codigo'=>'PROD-041','nombre'=>'Fundas Plásticas 20x30','cantidad'=>20,'precio'=>8.50,'min'=>4,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-042','nombre'=>'Contenedores Térmicos','cantidad'=>15,'precio'=>18.50,'min'=>3,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-043','nombre'=>'Vasos Desechables 12oz','cantidad'=>25,'precio'=>12.00,'min'=>5,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-044','nombre'=>'Servilletas','cantidad'=>20,'precio'=>6.50,'min'=>4,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-045','nombre'=>'Papel Aluminio','cantidad'=>10,'precio'=>4.20,'min'=>2,'cat'=>5,'uni'=>4,'prov'=>3],
            ['codigo'=>'PROD-046','nombre'=>'Cubiertos Desechables','cantidad'=>18,'precio'=>9.80,'min'=>3,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-047','nombre'=>'Fundas Basura Industrial','cantidad'=>15,'precio'=>15.00,'min'=>3,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-048','nombre'=>'Platos Desechables','cantidad'=>20,'precio'=>10.50,'min'=>4,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-049','nombre'=>'Sorbetes','cantidad'=>10,'precio'=>3.50,'min'=>2,'cat'=>5,'uni'=>5,'prov'=>3],
            ['codigo'=>'PROD-050','nombre'=>'Papel Film','cantidad'=>12,'precio'=>5.80,'min'=>2,'cat'=>5,'uni'=>4,'prov'=>3],
        ];

        foreach ($productos as $i => $p) {
            DB::table('productos')->insert([
                'id' => $i + 1,
                'categoria_id' => $p['cat'],
                'unidad_medida_id' => $p['uni'],
                'codigo' => $p['codigo'],
                'nombre' => $p['nombre'],
                'descripcion' => null,
                'stock_actual' => $p['cantidad'],
                'stock_minimo' => $p['min'],
                'precio_compra' => $p['precio'],
                'precio_venta' => null,
                'estado' => 'Activo',
                'created_at' => now(),
            ]);
        }

        // ================= 7. ENTRADAS + DETALLE (agrupadas por proveedor) =================
        $proveedorNombres = [
            1 => 'PRONACA S.A.',
            2 => 'LA PRESTANCIA S.A.',
            3 => 'PLÁSTICOS S.A.',
            4 => 'ZUU LÁCTEOS',
            5 => 'ECUAVEGETAL',
        ];

        $entradaId = 1;
        $detalleId = 1;

        foreach ($proveedorNombres as $provId => $provNombre) {
            $itemsDeEsteProveedor = array_filter($productos, fn ($p) => $p['prov'] === $provId);

            $total = 0;
            foreach ($itemsDeEsteProveedor as $item) {
                $total += $item['cantidad'] * $item['precio'];
            }

            DB::table('entradas')->insert([
                'id' => $entradaId,
                'usuario_id' => 3, // bodega
                'proveedor_id' => $provId,
                'fecha' => now(),
                'numero_factura' => 'FAC-' . str_pad($entradaId, 4, '0', STR_PAD_LEFT),
                'observacion' => 'Compra inicial de inventario - ' . $provNombre,
                'total' => round($total, 2),
            ]);

            foreach ($itemsDeEsteProveedor as $index => $item) {
                $productoId = array_search($item, $productos) + 1;
                $subtotal = $item['cantidad'] * $item['precio'];

                DB::table('detalle_entradas')->insert([
                    'id' => $detalleId,
                    'entrada_id' => $entradaId,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'subtotal' => round($subtotal, 2),
                ]);

                $detalleId++;
            }

            $entradaId++;
        }

        Schema::enableForeignKeyConstraints();
    }
}