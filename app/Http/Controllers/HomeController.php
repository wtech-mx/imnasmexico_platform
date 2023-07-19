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
use App\Models\Factura;
use App\Models\EnviosOrder;
use MercadoPago\SDK;
use App\Models\Cupon;

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
                $datachart[] = $totalPagado;
            }

            $now = Carbon::now();
            $fechaInicioSemana = $now->startOfWeek()->format('Y-m-d');
            $fechaFinSemana = $now->endOfWeek()->format('Y-m-d');

            $cursos = Cursos::select('id', 'nombre', 'foto', 'fecha_inicial', 'fecha_final', 'recurso', 'modalidad', 'slug', 'clase_grabada', 'clase_grabada2', 'clase_grabada3', 'clase_grabada4', 'clase_grabada5')
                ->whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])
                ->orderBy('id', 'DESC')
                ->get();

                $facturas = Factura::whereNotIn('estatus', ['Realizado', 'Sin procesar', 'Cancelada'])->get();
                $contadorfacturas = $facturas->count();

                $envios = EnviosOrder::whereNotIn('estatus', ['Realizado','Cancelado'])->get();
                $contadorenvios = $envios->count();
                $profesores =  User::where('cliente','2')->orderBy('name','DESC')->get();

                $data = User::where('cliente','=',null)->orderBy('id','DESC')->get();

                $cupones = Cupon::orderBy('id','DESC')->get();

                SDK::setAccessToken(config('services.mercadopago.token'));

                // Obtener pagos desde MercadoPago
                $today = date('Y-m-d');
                $lastMonthEndDate = date('Y-m-d', strtotime('-1 month -1 day'));
                $lastMonthStartDate = date('Y-m-01', strtotime('-1 month'));

                $filters = array(
                    "status" => "approved",
                    "begin_date" => $today."T00:00:00.000-00:00",
                    "end_date" => $today."T23:59:59.999-00:00",
                    "limit" => 100,
                    "offset" => 0
                );

                $pagos = array();

                do {
                    // Obtener siguiente página de resultados
                    $searchResult = \MercadoPago\Payment::search($filters);

                    // Obtener los resultados de la búsqueda
                    $results = $searchResult->getArrayCopy();

                    // Concatenar los resultados de la siguiente página con los resultados anteriores
                    $pagos = array_merge($pagos, $results);

                    // Incrementar el offset para obtener la siguiente página de resultados
                    $filters["offset"] += $filters["limit"];

                } while (count($results) > 0);

            return view('admin.dashboard',compact('totalPagadoFormateadoDia','clientesTotal','meses', 'datachart','cursos','contadorfacturas','contadorenvios','profesores','data','cupones', 'pagos'));
        }

    }
}
