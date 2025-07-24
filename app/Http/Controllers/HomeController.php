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
use App\Models\NominaTareas;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\RegistroImnas;
use App\Models\RegistroImnasEspecialidad;
use DB;

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
                $profesores =  User::where('cliente','2')->orWhere('cliente', '5')->orderBy('name','DESC')->get();

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

                $primerDiaDelMes = date('Y-m-01');
                $ultimoDiaDelMes = date('Y-m-t');

                $cotizacion_aprobadas = NotasProductosCosmica::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
                ->where('estatus_cotizacion','=' ,'Aprobada')->where('tipo_nota','=' , 'Cotizacion')->get();
                $cotizacion_NASCount = $cotizacion_aprobadas->count();

                $notasAprobadas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
                ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Aprobada')->get();
                $cotizacion_CosmicaCount = $notasAprobadas->count();

                $ventas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
                ->where('tipo_nota','=' , 'Venta Presencial')->get();
                $ventas_NASCount = $ventas->count();

                $registros_pendientes = RegistroImnas::where('fecha_compra', '!=', null)->where('fecha_realizados', '=', null)->where('tipo', '=', '1')->orderBy('id','DESC')->get();
                $especialidades_pendientes = RegistroImnasEspecialidad::where('especialidad', '!=', null)->where('estatus_imnas', '=', 1)->orderBy('id','DESC')->get();
                $envios_pendientes = OrdersTickets::where('id_tickets', '=', 137)
                ->where(function($query) {
                    $query->where('estatus_imnas', '!=', 0)
                          ->orWhereNull('estatus_imnas');  // Incluir registros con estatus_imnas en NULL
                })
                ->whereHas('Orders', function($query) {
                    $query->where('estatus', '=', 1); // Solo trae registros donde estatus sea 1 en Orders
                })
                ->get();

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

                // C O M I S I O N E S  V E N T A  K I T S
                $startOfWeek = Carbon::now()->startOfWeek();
                //  $startOfWeek = '2025-03-17';
                 $endOfWeek = Carbon::now()->endOfWeek();
                 //    $endOfWeek = '2025-03-23';

                $notasAprobadasCosmicaComision = NotasProductosCosmica::whereBetween('fecha_aprobada', [$startOfWeek, $endOfWeek])
                ->where('tipo_nota', 'Cotizacion')
                ->whereDoesntHave('productos', function ($query) {
                    $query->where('id_producto', 1989);
                })
                ->orderBy('id', 'DESC')
                ->get();

                $totalVentas = $notasAprobadasCosmicaComision->sum('total'); // Asumiendo que la columna 'total' contiene el monto de cada venta

                // Determinar la comisión grupal
                $comisionGrupal = 0;
                if ($totalVentas >= 60000 && $totalVentas <= 80000) {
                    $comisionGrupal = 1000;
                } elseif ($totalVentas >= 100000 && $totalVentas <= 149999) {
                    $comisionGrupal = 2000;
                } elseif ($totalVentas >= 150000) {
                    $comisionGrupal = 3000;
                }

            $avisos = NominaTareas::latest()->get();
            $user_avisos = auth()->user();
            foreach($avisos as $aviso) {
                $user_avisos->avisos()->syncWithoutDetaching([
                $aviso->id => ['visto_en' => now()]
                ]);
            }
            return view('admin.dashboard',compact('cotizacion_NASCount', 'ventas_NASCount', 'cotizacion_CosmicaCount', 'totalPagadoFormateadoDia','clientesTotal','meses', 'datachart','cursos','contadorfacturas','contadorenvios','profesores','cupones', 'pagos', 'registros_pendientes', 'especialidades_pendientes', 'envios_pendientes', 'totalVentas', 'comisionGrupal', 'avisos'));
        }

    }

}
