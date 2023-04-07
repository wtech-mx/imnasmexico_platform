<?php

namespace App\Providers;


use App\Models\Configuracion;
use Illuminate\Support\ServiceProvider;
use App\Models\Cursos;
use DateInterval;
use DateTime;


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
            $configuracion = Configuracion::first();

            $fechaActual = date('Y-m-d');
            $curso = Cursos::where('estatus', '=', '1')->where('fecha_final', '<', $fechaActual)->OrderBy('fecha_final', 'ASC')->first();

            if($curso){
                $curso->estatus = '0';
                $curso->update();
            }

            // Obtener la fecha y hora actual
            $fechaHoraActual = new DateTime();

            // Sumar 72 horas a la fecha y hora actual
            $intervalo = new DateInterval('PT72H');
            $fechaHoraActual->add($intervalo);

            // Obtener la nueva fecha y hora después de sumar 72 horas
            $fechaHoraFutura = $fechaHoraActual->format('Y-m-d H:i:s');

            // Asignar la nueva fecha y hora al objeto Cursos
            $curso2 = Cursos::where('video_cad', '=', '1')->first();
            if($curso2){
                if($fechaHoraFutura <= $curso2->video_cad){
                    $curso2->video_cad = '0';
                    $curso2->update();
                }
            }

            $view->with(['configuracion' => $configuracion, 'fechaActual' => $fechaActual]);
        });
    }
}
