<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Models\Product;
use App\Models\Comentarios;
class HomeUsersController extends Controller
{
    public function index(){
        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::where('estatus','=', '1')->get();
        $unam = Cursos::where('seccion_unam', '=', 1)->where('estatus','=', '1')->get();
        $comentarios = Comentarios::get();


        $tickets = CursosTickets::where('fecha_final','>=', $fechaActual)->get();

        // $woocomerce = new Product(
        //     'https://imnasmexico.com/new/wp-json/wc/v3/products?category=202',
        //     'ck_9868525631eee54f198be17abf22ee6e2a1bb221',
        //     'cs_7b2f0584b817cf11e6dabae2d113b72e6315f186',
        //     [
        //         'wp_api' => true,
        //         'version' => 'wc/v3',
        //         'query_string_auth' => true,
        //     ]
        // );
        //  $json2 = $data2['products'] = $woocomerce->all(['per_page'=> '10','orderby' => 'date','order' => 'asc',]);

        //  $decode2 = json_decode($json2);

        //  $resultados = array_merge($decode2);

        return view('user.home', compact('cursos', 'unam', 'tickets','comentarios'));
    }
}
