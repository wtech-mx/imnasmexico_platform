<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Servicios;
use App\Models\User;
use App\Models\Cursos;
use App\Models\CursosTickets;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Models\Product;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Carbon\Carbon;
use DateTime;
use App\Models\WebPage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->cliente == 1){
            $DateAndTime = date('h:i', time());
            $fechaActual = date('Y-m-d');
            $cursos = Cursos::where('fecha_final', '>=', $fechaActual)->where('estatus','=', '1')->get();
            $unam = Cursos::where('unam', '=', 1)->where('fecha_final', '>=', $fechaActual)->where('estatus','=', '1')->get();

            $tickets = CursosTickets::where('fecha_final','>=', $fechaActual)->get();

            $woocomerce = new Product(
                'https://imnasmexico.com/new/wp-json/wc/v3/products?category=202',
                'ck_9868525631eee54f198be17abf22ee6e2a1bb221',
                'cs_7b2f0584b817cf11e6dabae2d113b72e6315f186',
                [
                    'wp_api' => true,
                    'version' => 'wc/v3',
                    'query_string_auth' => true,
                ]
            );
             //Trae datos de db to jason
             $json2 = $data2['products'] = $woocomerce->all(['per_page'=> '10','orderby' => 'date','order' => 'asc',]);

             //los convieerte en array
             $decode2 = json_decode($json2);

             //Une los array en uno solo
             $resultados = array_merge($decode2);

            return view('user.home', compact('cursos', 'resultados', 'unam', 'tickets'));
        }else{


            $fechaHoraActual = date('Y-m-d');
            $orders = Orders::where('fecha', $fechaHoraActual)
            ->where('estatus', '1')
            ->orderBy('id','DESC')
            ->get();

            $totalPagadoDia = $orders->sum('pago');
            $totalPagadoFormateadoDia = number_format($totalPagadoDia, 2, '.', ',');

            $clientesTotal = User::where('cliente', '=', '1')->count();

            $meses = [];
            $totalPagados = [];

            for ($i = 1; $i <= 12; $i++) {
                $meses[] = DateTime::createFromFormat('!n', $i)->format('M'); // Obtener el nombre del mes;

                $orders = Orders::whereMonth('fecha', '=', $i)
                    ->where('estatus', '1')
                    ->where('pago', '>', 0)
                    ->orderBy('id', 'DESC')
                    ->get();

                $totalPagado = $orders->sum('pago');
                $data[] = $totalPagado;
            }

            return view('admin.dashboard',compact('totalPagadoFormateadoDia','clientesTotal','meses', 'data'));
        }

    }
}
