<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class EnviaService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://queries.envia.com/guide';
        $this->apiKey = env('ENVIA_API_KEY');
    }

    /**
     * Obtener envíos de Envia.com
     *
     * @param int|null $month Mes en formato MM
     * @param int|null $year Año en formato YYYY
     * @param array $params Parámetros adicionales de filtro
     * @return array|null
     */
    public function getShipments($month = null, $year = null, array $params = [])
    {
        // Mes y año actuales si no se especifican
        $month = $month ?? Carbon::now()->format('m');
        $year = $year ?? Carbon::now()->format('Y');

        // Construcción de la URL
        $url = "{$this->apiUrl}/{$month}/{$year}";

        // Solicitud a Envia.com con el Bearer Token y parámetros de filtro
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url, $params);

        // Verifica si la respuesta fue exitosa
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
