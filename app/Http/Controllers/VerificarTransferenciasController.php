<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use Carbon\Carbon;

class VerificarTransferenciasController extends Controller
{
    public function index(){

        return view('admin.transferencias.index');
    }

    public function store(Request $request)
    {
        // Datos recibidos del formulario
        $tipoCriterio = $request->input('tipoCriterio');
        $fecha = $request->input('fecha');
        $criterio = $request->input('criterio');
        $emisor = $request->input('emisor');
        $receptor = $request->input('receptor');
        $cuenta = $request->input('cuenta');
        $receptorParticipante = filter_var($request->input('receptorParticipante'), FILTER_VALIDATE_BOOLEAN);
        $monto = (float)$request->input('monto');

        // Formatear la fecha en el formato yyyy-MM-dd
        $fechaFormateada = Carbon::createFromFormat('Y-m-d', $fecha)->format('d-m-Y'); // Formatea la fecha a "DD-MM-YYYY"

        $body = json_encode([
            'tipoCriterio' => $tipoCriterio,
            'fecha' => $fecha,
            'criterio' => $criterio,
            'emisor' => $emisor,
            'receptor' => $receptor,
            'cuenta' => $cuenta,
            'receptorParticipante' => $receptorParticipante,
            'monto' => $monto,
        ]);


        // try {
            // Configurar el cliente Guzzle
            $client = new GuzzleClient();

            $response = $client->request('POST', 'https://link.kiban.cloud/api/v2/cep/validate', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'x-api-key' => '1K8EH2H0D9YCRC-1T3RGCZ000013Y-C6X6-1FQV1DJPQ', //produccion
                    // 'x-api-key' => '1K8EH2H0D9YCRC-1T3RGCZ000013Y-11VD-1FQSB66Q8', //sandbox

                ],
                'body' => $body,
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);
         
            return view('admin.transferencias.resultado', ['data' => $data]);

        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     // Captura errores 4xx
        //     if ($e->getResponse()->getStatusCode() == 404) {
        //         $error = 'Transferencia no encontrada. Inténtelo de nuevo.';
        //     } else {
        //         $error = 'Error al procesar la transferencia. Inténtelo de nuevo.';
        //     }

        //     return view('admin.transferencias.resultado', ['error' => $error]);

        // } catch (\Exception $e) {
        //     // Captura cualquier otro error
        //     $error = 'Error inesperado. Inténtelo de nuevo.';
        //     return view('admin.transferencias.resultado', ['error' => $error]);
        // }
    }


}
