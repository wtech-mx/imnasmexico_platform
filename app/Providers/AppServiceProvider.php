<?php

namespace App\Providers;


use App\Models\Configuracion;
use App\Models\WebPage;
use Illuminate\Support\ServiceProvider;
use App\Models\Cursos;
use Carbon\Carbon;
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
            $webpage = WebPage::first();

            $fechaActual = date('Y-m-d');
            $curso = Cursos::where('estatus', '=', '1')->where('fecha_final', '<', $fechaActual)->OrderBy('fecha_final', 'ASC')->first();

            if($curso){
                $curso->estatus = '0';
                $curso->update();
            }

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

            $view->with(['configuracion' => $configuracion,'webpage' => $webpage, 'fechaActual' => $fechaActual]);
        });
    }
}
