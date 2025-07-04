<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StpController extends Controller
{
    /**
     * Muestra el formulario para que el usuario ingrese los datos.
     */
    public function showForm()
    {
        return view('stp.firma_form');
    }

    /**
     * Recibe los datos, genera la firma y la muestra.
     */
    public function generateSignature(Request $request)
    {
        $data = $request->validate([
            'empresa'         => 'required|string',
            'cuentaOrdenante' => 'required|string',
            'fecha'           => 'nullable|digits:8',
        ]);

        // 1) Ruta al PEM en public/stp_leys
        $privateKeyPath = public_path('stp_leys/inmas.pem');
        if (! file_exists($privateKeyPath)) {
            return back()->withErrors("No existe el archivo de llave privada en {$privateKeyPath}");
        }

        // 2) Cargar la clave (si tu PEM lleva passphrase, ajústalo aquí)
        $pem    = file_get_contents($privateKeyPath);
        $pass   = 'X}Zl0/RtjuI(=Esz3+Vq'; // tu passphrase
        $pkey   = openssl_pkey_get_private($pem, $pass);
        if (! $pkey) {
            return back()->withErrors('No pude cargar la clave privada (¿passphrase correcta?)');
        }

        // 3) Construir cadena original
        $empresa         = $data['empresa'];
        $cuentaOrdenante = $data['cuentaOrdenante'];
        $fecha           = $data['fecha'] ?? null;

        if ($fecha && strlen($fecha) === 8) {
            $cadena = "||{$empresa}|{$cuentaOrdenante}|{$fecha}||";
        } else {
            $cadena = "||{$empresa}|{$cuentaOrdenante}|||";
        }

        // 4) Firmar con SHA256+RSA
        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('La firma falló inesperadamente.');
        }

        $firmaB64 = base64_encode($bin);

        return view('stp.firma_form', [
            'cadena'   => $cadena,
            'firmaB64' => $firmaB64,
        ]);
    }

    public function showOperacionesForm()
    {
        return view('stp.operaciones_form');
    }

    /**
     * Procesa la consulta de operaciones según el tipo seleccionado.
     */
    public function consultaOperaciones(Request $request)
    {
        $data = $request->validate([
            'tipo'               => 'required|in:actual,historica,natural',
            'empresa'            => 'required|string',
            'pagina'             => 'required|integer|min:0',
            'fechaOperacion'     => 'nullable|digits:8',
            'fechaNatural'       => 'nullable|digits:8',
            'horaCapturaInicio'  => 'nullable|digits:6',
            'horaCapturaFin'     => 'nullable|digits:6',
        ]);

        // 1) Construir cadena original
        switch ($data['tipo']) {
            case 'actual':
                $cadena = "||{$data['empresa']}||";
                $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/operaciones/actual';
                break;

            case 'historica':
                if (! $data['fechaOperacion']) {
                    return back()->withErrors('Para histórica necesitas fechaOperacion (AAAAMMDD).');
                }
                $cadena = "||{$data['empresa']}|{$data['fechaOperacion']}||";
                $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/operaciones/historica';
                break;

            case 'natural':
                if (! $data['fechaNatural']) {
                    return back()->withErrors('Para natural necesitas fechaNatural (AAAAMMDD).');
                }
                $inicio = $data['horaCapturaInicio'] ?? '';
                $fin    = $data['horaCapturaFin']    ?? '';
                $cadena = "||{$data['empresa']}|{$data['fechaNatural']}|{$inicio}|{$fin}||";
                $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/operaciones/fechaNatural';
                break;
        }


        // 2) Generar firma
        $privateKeyPath = public_path('stp_leys/inmas.pem');
        $pem    = file_get_contents($privateKeyPath);
        $pass   = 'X}Zl0/RtjuI(=Esz3+Vq';
        $pkey   = openssl_pkey_get_private($pem, $pass);
        if (! $pkey) {
            return back()->withErrors('No pude cargar la clave privada.');
        }

        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('Falló la generación de la firma.');
        }
        $firma = base64_encode($bin);

        // 3) Preparar payload
        $payload = [
            'empresa' => $data['empresa'],
            'firma'   => $firma,
            'pagina'  => $data['pagina'],
        ];
        if ($data['tipo'] === 'historica') {
            $payload['fechaOperacion'] = $data['fechaOperacion'];
        }
        if ($data['tipo'] === 'natural') {
            $payload['fechaNatural']      = $data['fechaNatural'];
            if ($data['horaCapturaInicio']) {
                $payload['horaCapturaInicio'] = $data['horaCapturaInicio'];
            }
            if ($data['horaCapturaFin']) {
                $payload['horaCapturaFin']    = $data['horaCapturaFin'];
            }
        }


        // 4) Llamar al servicio STP
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        if (! $response->successful()) {
            return back()->withErrors('Error en la consulta: '.$response->status());
        }

        $resultado = $response->json();

        // 5) Mostrar vista con resultados
        return view('stp.operaciones_form', [
            'resultado' => $resultado,
            'cadena'    => $cadena,
            'firma'     => $firma,
            'payload'   => $payload,
        ]);
    }

    public function showOrdenRastreoForm()
    {
        return view('stp.orden_rastreo_form');
    }

    /**
     * Procesa la consulta de orden por claveRastreo
     */
    public function consultaOrdenRastreo(Request $request)
    {
        $data = $request->validate([
            'empresa'       => 'required|string',
            'tipoOrden'     => 'required|in:E,R',
            'claveRastreo'  => 'required|string',
            'fechaOperacion'=> 'nullable|digits:8',
            'fechaNatural'  => 'nullable|digits:8',
        ]);

        // 1) Construir cadena original
        // ||empresa|claveRastreo|tipoOrden||fechaOperacion||
        // ||empresa|claveRastreo|tipoOrden|fechaNatural|||
        if (! empty($data['fechaOperacion'])) {
            $cadena = "||{$data['empresa']}|{$data['claveRastreo']}|{$data['tipoOrden']}||{$data['fechaOperacion']}||";
        } elseif (! empty($data['fechaNatural'])) {
            $cadena = "||{$data['empresa']}|{$data['claveRastreo']}|{$data['tipoOrden']}|{$data['fechaNatural']}|||";
        } else {
            return back()->withErrors('Debes proporcionar fechaOperacion o fechaNatural.');
        }

        // 2) Generar firma (idéntico al otro método)
        $privateKeyPath = public_path('stp_leys/inmas.pem');
        $pem    = file_get_contents($privateKeyPath);
        $pass   = 'X}Zl0/RtjuI(=Esz3+Vq';
        $pkey   = openssl_pkey_get_private($pem, $pass);
        if (! $pkey) {
            return back()->withErrors('No pude cargar la clave privada.');
        }

        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('Falló la generación de la firma.');
        }
        $firma = base64_encode($bin);

        // 3) Preparar payload
        $payload = [
            'empresa'      => $data['empresa'],
            'tipoOrden'    => $data['tipoOrden'],
            'claveRastreo' => $data['claveRastreo'],
            'firma'        => $firma,
        ];
        if (! empty($data['fechaOperacion'])) {
            $payload['fechaOperacion'] = $data['fechaOperacion'];
        } else {
            $payload['fechaNatural'] = $data['fechaNatural'];
        }

        // 4) Llamar al endpoint
        $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/orden/clave-rastreo';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        if (! $response->successful()) {
            return back()->withErrors("Error HTTP: {$response->status()}");
        }

        $resultado = $response->json();

        // 5) Mostrar vista con todo
        return view('stp.orden_rastreo_form', [
            'resultado' => $resultado,
            'cadena'    => $cadena,
            'firma'     => $firma,
            'payload'   => $payload,
        ]);
    }

    public function showComprobanteForm()
    {
        return view('stp.comprobante_form');
    }

    /**
     * Procesa la consulta de comprobante
     */
    public function consultaComprobante(Request $request)
    {
        $data = $request->validate([
            'empresa'         => 'required|string',
            'claveRastreo'    => 'required|string',
            'fechaOperacion'  => 'nullable|digits:8',
            'fechaNatural'    => 'nullable|digits:8',
        ]);

        // 1) Construir la cadena original:
        // Si usan fechaNatural:  ||empresa|claveRastreo|fechaNatural|||
        // Si usan fechaOperacion:||empresa|claveRastreo||fechaOperacion||
        if (! empty($data['fechaNatural'])) {
            $cadena = "||{$data['empresa']}|{$data['claveRastreo']}|{$data['fechaNatural']}|||";
        } elseif (! empty($data['fechaOperacion'])) {
            $cadena = "||{$data['empresa']}|{$data['claveRastreo']}||{$data['fechaOperacion']}||";
        } else {
            return back()->withErrors('Debes proveer fechaNatural o fechaOperacion.');
        }

        // 2) Firmar igual que antes:
        $pemPath = public_path('stp_leys/inmas.pem');
        $pem     = file_get_contents($pemPath);
        $pass    = 'X}Zl0/RtjuI(=Esz3+Vq';
        $pkey    = openssl_pkey_get_private($pem, $pass);
        if (!$pkey) {
            return back()->withErrors('No se pudo cargar la llave privada.');
        }
        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('Error generando la firma.');
        }
        $firma = base64_encode($bin);

        // 3) Armar el JSON de entrada
        $payload = [
            'empresa'      => $data['empresa'],
            'claveRastreo' => $data['claveRastreo'],
            'firma'        => $firma,
        ];
        if (! empty($data['fechaNatural'])) {
            $payload['fechaNatural'] = $data['fechaNatural'];
        } else {
            $payload['fechaOperacion'] = $data['fechaOperacion'];
        }

        // 4) Llamar al endpoint
        $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/comprobante';
        $resp = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        if (! $resp->successful()) {
            return back()->withErrors("Error HTTP: {$resp->status()}");
        }

        $resultado = $resp->json();

        // 5) Renderizar la misma vista con resultados
        return view('stp.comprobante_form', [
            'cadena'    => $cadena,
            'firma'     => $firma,
            'payload'   => $payload,
            'resultado' => $resultado,
        ]);
    }

    public function showConciliacionForm()
    {
        return view('stp.conciliacion_form');
    }

    /**
     * Procesa la consulta de conciliación
     */
    public function consultaConciliacion(Request $request)
    {
        $data = $request->validate([
            'empresa'        => 'required|string',
            'pagina'         => 'required|integer|min:0',
            'fechaOperacion' => 'nullable|digits:8',
        ]);

        // 1) Cadena original
        if (! empty($data['fechaOperacion'])) {
            // histórica
            $cadena = "||{$data['empresa']}|{$data['fechaOperacion']}||";
            $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/conciliacion/historica';
        } else {
            // actual
            $cadena = "||{$data['empresa']}||";
            $endpoint = 'https://efws-dev.stpmex.com/consultasws/API/conciliacion/actual';
        }

        // 2) Firma SHA256-RSA
        $pemPath = public_path('stp_leys/inmas.pem');
        $pem     = file_get_contents($pemPath);
        $pass    = 'X}Zl0/RtjuI(=Esz3+Vq';
        $pkey    = openssl_pkey_get_private($pem, $pass);
        if (! $pkey) {
            return back()->withErrors('No se pudo cargar la clave privada.');
        }
        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('Error al generar la firma.');
        }
        $firma = base64_encode($bin);

        // 3) Payload
        $payload = [
            'empresa' => $data['empresa'],
            'firma'   => $firma,
            'pagina'  => $data['pagina'],
        ];
        if (! empty($data['fechaOperacion'])) {
            $payload['fechaOperacion'] = $data['fechaOperacion'];
        }

        // 4) Llamada REST
        $resp = Http::withHeaders(['Content-Type'=>'application/json'])
            ->post($endpoint, $payload);

        if (! $resp->successful()) {
            return back()->withErrors("Error HTTP {$resp->status()}");
        }

        $resultado = $resp->json();

        // 5) Renderizar
        return view('stp.conciliacion_form', compact('cadena','firma','payload','resultado'));
    }

    public function showInstitucionesForm()
    {
        return view('stp.instituciones_form');
    }

    /**
     * Ejecutar consulta de instituciones a STP
     */
    public function consultaInstituciones(Request $request)
    {
        // Validar
        $data = $request->validate([
            'empresa' => 'required|string|max:15',
        ]);

        // 1) Cadena original fija
        $cadena   = "||{$data['empresa']}||";

        // 2) Firmar
        $pemPath  = public_path('stp_leys/inmas.pem');
        $pem      = file_get_contents($pemPath);
        $pass     = 'X}Zl0/RtjuI(=Esz3+Vq';
        $pkey     = openssl_pkey_get_private($pem, $pass);
        if (! $pkey) {
            return back()->withErrors('No se pudo cargar la clave privada.');
        }
        if (! openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256)) {
            return back()->withErrors('Error al generar la firma.');
        }
        $firma = base64_encode($bin);

        // 3) Payload
        $payload = [
            'empresa' => $data['empresa'],
            'firma'   => $firma,
        ];

        // 4) Llamada REST
        $endpoint = 'https://efws-dev.stpmex.com/efws/API/consultaInstituciones';
        $resp = Http::withHeaders(['Content-Type'=>'application/json'])
            ->post($endpoint, $payload);

        if (! $resp->successful()) {
            return back()->withErrors("HTTP {$resp->status()}: {$resp->body()}");
        }

        $resultado = $resp->json();

        // 5) Mostrar formulario + resultado
        return view('stp.instituciones_form', compact('cadena','firma','payload','resultado'));
    }
}
