<?php

namespace App\Providers;


use App\Models\Configuracion;
use App\Models\WebPage;
use Illuminate\Support\ServiceProvider;
use App\Models\Cursos;
use App\Models\Revoes;
use App\Models\Estandar;
use App\Models\Manual;
use App\Models\Noticias;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use App\Models\BodegaPedidos;
use App\Models\Caja;
use App\Models\OrdersCosmica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Str;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            // Obtener la URL completa
            $urlCompleta = URL::current();
            // Obtener el dominio
            $dominio = URL::to('/');
            // Obtener lo que sigue al dominio
            $ruta = Str::after($urlCompleta, $dominio);

            $configuracion = Configuracion::first();
            $webpage = WebPage::first();
            $estandares = Estandar::get();
            $revoes = Revoes::get();
            $noticias = Noticias::orderBy('orden','ASC')->get();
            $manuales = Manual::where('modulo','=',$ruta)->first();

            $fechaActual = date('Y-m-d');
            $curso = Cursos::where('estatus', '=', '1')->where('fecha_final', '<', $fechaActual)->OrderBy('fecha_final', 'ASC')->first();

            if($curso){
                $curso->estatus = '0';
                $curso->update();
            }

            $noticias_inicio = Noticias::where('seccion', '=', 'Inicio')->get();
            // Asignar la nueva fecha y hora al objeto Cursos
            $curso2 = Cursos::where('video_cad', '=', '1')->first();

            // Obtener la fecha actual
            $fechaActual = Carbon::now();

            if($curso2){
                // Verificar si ha pasado más de 72 horas desde la fecha de subida del video
                if ($fechaActual->diffInHours($curso2->fecha_video) <= 72) {
                    // Mostrar el video al usuario
                } else {
                    // El video ha expirado, mostrar mensaje de error
                    $curso2->video_cad = '0';
                    $curso2->update();
                }
            }

            // SPAN NAS
            $count_pedidos = BodegaPedidos::where('estatus_lab', '=', 'Aprobada')->get();

            $registroHoy = Caja::whereDate('fecha', now()->toDateString())->exists();
            if($registroHoy){

            }else{
                $totalDiaAnterior = Caja::orderBy('fecha', 'desc')->value('total');

                Caja::create([
                    'fecha' => now(),
                    'ingresos' => $totalDiaAnterior,
                    'inicio' => $totalDiaAnterior,
                ]);
            }
            $oreder_cosmica = OrdersCosmica::where('estatus','=' , '1')->get();

            $view->with(['count_pedidos' => $count_pedidos, 'noticias_inicio' => $noticias_inicio,'configuracion' => $configuracion,'webpage' => $webpage,'estandares' => $estandares,'revoes' => $revoes, 'fechaActual' => $fechaActual,'manuales' => $manuales,'noticias' => $noticias, 'oreder_cosmica' => $oreder_cosmica]);
        });
    }
}
