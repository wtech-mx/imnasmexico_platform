<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;

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
        $criterio = $request->input('criterio'); // Asegúrate de tener este campo en el formulario
        $emisor = $request->input('emisor');
        $receptor = $request->input('receptor');
        $cuenta = $request->input('cuenta');
        $receptorParticipante = $request->input('receptorParticipante');
        $monto = $request->input('monto');

        // Formatear la fecha en el formato yyyy-MM-dd
        $fechaFormateada = \Carbon\Carbon::parse($fecha)->format('Y-m-d');

        // Crear el cuerpo de la solicitud como una cadena JSON
        $body = json_encode([
            'tipoCriterio' => $tipoCriterio,
            'fecha' => $fechaFormateada,
            'criterio' => $criterio, // Aquí debes proporcionar el valor adecuado para "criterio"
            'emisor' => $emisor,
            'receptor' => $receptor,
            'cuenta' => $cuenta,
            'receptorParticipante' => filter_var($receptorParticipante, FILTER_VALIDATE_BOOLEAN),
            'monto' => $monto,
        ]);



        // Configurar el cliente Guzzle
        $client = new GuzzleClient();

        // try {

            $response = $client->post('https://sandbox.link.kiban.com/api/v2/cep/validate?testCaseId=663567bb713cf2110a11069f', [
                'body' => $body,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'x-api-key' => '1K8EH2H0D9YCRC-1T3RGCZ000013Y-11VD-1FQSB66Q8',
                ],
            ]);

            $body = $response->getBody();
            dd($body);

            $content = json_decode($body, true);

            // Aquí puedes procesar la respuesta como desees

        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     // Obtener y mostrar el cuerpo de la respuesta de error
        //     $responseBody = $e->getResponse()->getBody(true);
        //     return response()->json(['error' => $responseBody], 400);
        // } catch (\Exception $e) {
        //     // Manejar otros errores
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }

}
