<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'client-show',
           'client-documentos',
           'client-compras',
           'client-edit',
           'productos-show',
           'productos-create',
           'productos-edit',
           'usuarios-list',
           'usuarios-create',
           'usuarios-edit',
           'usuarios-delete',
           'cursos-show',
           'cursos-create',
           'cursos-edit',
           'cursos-lista',
           'cursos-duplicar',
           'cursos-ligas',
           'cursos-inscribir-lista',
           'carpeta-compartida-show',
           'carpeta-compartida-create',
           'carpeta-compartida-edit',
           'nota-cursos-show',
           'nota-cursos-crear',
           'nota-cursos-pago',
           'nota-cursos-paquetes',
           'nota-productos-show',
           'nota-productos-editar',
           'nota-productos-whats',
           'nota-productos-crear',
           'cupon-show',
           'cupon-create',
           'cupon-edit',
           'publicidad-show',
           'publicidad-agregar',
           'publicidad-eliminar',
           'ordenes-show',
           'ordenes-edit',
           'mercado-pago',
           'factura-show',
           'factura-ver',
           'factura-compra',
           'factura-subir',
           'profesores-show',
           'profesores-create',
           'profesores-edit',
           'caja',
           'carpeta-estandares-show',
           'carpeta-estandares-create',
           'carpeta-estandares-edit',
           'envios-show',
           'envios-edit',
           'pagina-show',
           'pagina-edit',
           'reporte-mes',
           'reporte-semana',
           'reporte-dia',
           'reporte-personalizado',
           'configuracion',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
