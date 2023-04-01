<?php

namespace App\Providers;


use App\Models\Configuracion;
use Illuminate\Support\ServiceProvider;
use App\Models\Cursos;


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

            $view->with(['configuracion' => $configuracion, 'fechaActual' => $fechaActual]);
        });
    }
}
