<?php

namespace App\Http\Controllers;

use App\Services\EnviaService;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;

class ShipmentController extends Controller
{
    protected $enviaService;

    public function __construct(EnviaService $enviaService)
    {
        $this->enviaService = $enviaService;
    }

    public function getShipments(HttpRequest $request)
    {
        $client = new Client();
        $token = '65e827527c2bae285be787c4618cfd09fb10cd2499befe49ee25c1d2fe21a658';

        // Definir el mes y año por defecto si no se especifica un rango de fechas
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $startDate = null;
        $endDate = null;

        // Verificar todos los parámetros enviados
        // Si se envía un rango de fechas, ajustamos el mes y año para la solicitud
        if ($request->has(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
            $month = $startDate->format('m');
            $year = $startDate->format('Y');
        }

        $url = "https://queries.envia.com/guide/{$month}/{$year}";
        $apiRequest = new Request('GET', $url, [
            'Authorization' => "Bearer {$token}",
            'Accept' => 'application/json'
        ]);


        try {
            $response = $client->send($apiRequest);
            $data = json_decode($response->getBody()->getContents(), true);

            return view('admin.api.envia.shipments', ['shipments' => $data['data'] ?? []]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al obtener los envíos: ' . $e->getMessage()]);
        }
    }

}
