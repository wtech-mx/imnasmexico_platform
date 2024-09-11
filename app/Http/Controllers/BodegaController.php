<?php

namespace App\Http\Controllers;

use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index_preparacion(){
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_preparado = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_enviados = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_preparado = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_cosmica_enviados = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        return view('admin.bodega.index', compact('notas_preparacion', 'notas_preparado', 'notas_enviados', 'notas_cosmica_preparacion', 'notas_cosmica_preparado', 'notas_cosmica_enviados'));
    }

}
