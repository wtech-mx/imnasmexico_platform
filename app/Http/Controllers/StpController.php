<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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

    public function showRegistraForm()
    {
        return view('stp.registra_form');
    }

        // Procesa la orden
    public function registraOrden(Request $r)
    {
        // 1) Validación de sólo los campos que en tu ejemplo envías
        $f = $r->validate([
            'institucionContraparte'   => 'required|digits:5',
            'empresa'                  => 'required|string|max:15',
            'fechaOperacion'           => 'nullable|digits:8',
            'folioOrigen'              => 'nullable|string|max:50',
            'claveRastreo'             => 'required|string|max:30',
            'institucionOperante'      => 'required|digits:5',
            'monto'                    => 'required|numeric',
            'tipoPago'                 => 'required',
            'tipoCuentaOrdenante'      => 'required|digits:2',
            'nombreOrdenante'          => 'required|string|max:40',
            'cuentaOrdenante'          => 'required|string|max:20',
            'rfcCurpOrdenante'         => 'required|string|max:18',
            'tipoCuentaBeneficiario'   => 'required|digits:2',
            'nombreBeneficiario'       => 'required|string|max:40',
            'cuentaBeneficiario'       => 'required|string|max:20',
            'rfcCurpBeneficiario'      => 'required|string|max:18',
            'referenciaNumerica'       => 'required|digits_between:1,7',
            'latitud'                    => 'required|string|max:30',
            'longitud'                   => 'required|string|max:30',
            'conceptoPago'             => 'required|string|max:40',
        ]);

        // 2) Montar el arreglo DE 28 elementos en este caso (hasta referenciaNumerica),
        //    reservando vacío para todos los opcionales intermedios:
    $campos = [
    /*  1 */ $f['institucionContraparte'],
    /*  2 */ $f['empresa'],
    /*  3 */ '',                            // fechaOperacion (vacío)
    /*  4 */ '',                            // folioOrigen   (vacío)
    /*  5 */ $f['claveRastreo'],
    /*  6 */ $f['institucionOperante'],
    /*  7 */ number_format($f['monto'],2,'.',''),
    /*  8 */ $f['tipoPago'],
    /*  9 */ $f['tipoCuentaOrdenante'],
    /* 10 */ $f['nombreOrdenante'],
    /* 11 */ $f['cuentaOrdenante'],
    /* 12 */ $f['rfcCurpOrdenante'],
    /* 13 */ $f['tipoCuentaBeneficiario'],
    /* 14 */ $f['nombreBeneficiario'],
    /* 15 */ $f['cuentaBeneficiario'],
    /* 16 */ $f['rfcCurpBeneficiario'],
    /* 17 */ '',   // emailBeneficiario
    /* 18 */ '',   // tipoCuentaBeneficiario2
    /* 19 */ '',   // nombreBeneficiario2
    /* 20 */ '',   // cuentaBeneficiario2
    /* 21 */ '',   // rfcCurpBeneficiario2
    /* 22 */ $f['conceptoPago'],
    /* 23 */ '',   // conceptoPago2
    /* 24 */ '',   // claveCatUsuario1
    /* 25 */ '',   // claveCatUsuario2
    /* 26 */ '',   // clavePago
    /* 27 */ '',   // referenciaCobranza
    /* 28 */ $f['referenciaNumerica'],
    // ahora 6 posiciones vacías más para llegar a 34
    /* 29 */ '',
    /* 30 */ '',
    /* 31 */ '',
    /* 32 */ '',
    /* 33 */ '',
    /* 34 */ '',
    ];

    // 3) Armas la cadena con doble pipe:
    $cadena = '||'.implode('|', $campos).'||';

        // 3) La firmamos igual que antes
        $pem  = file_get_contents(public_path('stp_leys/inmas.pem'));
        $pkey = openssl_pkey_get_private($pem, 'X}Zl0/RtjuI(=Esz3+Vq');
        openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256);
        $firma = base64_encode($bin);

        // 4) Payload: solo tus campos + firma
        $payload = [
        'claveRastreo'           => $f['claveRastreo'],
        'conceptoPago'           => $f['conceptoPago'],
        'cuentaOrdenante'        => $f['cuentaOrdenante'],
        'cuentaBeneficiario'     => $f['cuentaBeneficiario'],
        'empresa'                => $f['empresa'],
        'institucionContraparte' => $f['institucionContraparte'],
        'institucionOperante'    => $f['institucionOperante'],
        'monto'                  => number_format($f['monto'],2,'.',''),
        'nombreBeneficiario'     => $f['nombreBeneficiario'],
        'nombreOrdenante'        => $f['nombreOrdenante'],
        'referenciaNumerica'     => $f['referenciaNumerica'],
        'rfcCurpBeneficiario'    => $f['rfcCurpBeneficiario'],
        'rfcCurpOrdenante'       => $f['rfcCurpOrdenante'],
        'tipoCuentaBeneficiario' => $f['tipoCuentaBeneficiario'],
        'tipoCuentaOrdenante'    => $f['tipoCuentaOrdenante'],
        'tipoPago'               => $f['tipoPago'],
        'latitud'               => $f['latitud'],
        'longitud'               => $f['longitud'],
        'firma'                  => $firma,
        ];

        // 5) Envío a STP
        $resp = Http::withHeaders(['Content-Type'=>'application/json'])
                    ->put('https://demo.stpmex.com:7024/speiws/rest/ordenPago/registra', $payload);

        // 6) Mostrar la misma vista con los resultados
        return view('stp.registra_form', compact('f','cadena','firma','payload','resp'));
    }

    public function webhookEstado(Request $request)
    {
        $data = $request->validate([
            'id'               => 'required|integer',
            'empresa'          => 'required|string|max:15',
            'claveRastreo'     => 'required|string|max:30',
            'estado'           => 'required|string|in:LQ,CN,D',
            'tsLiquidacion'    => 'nullable',
        ]);

        Log::info('STP Cambio de Estado recibido:', $data);

        // Si es devolución, devolvemos 400 con el JSON que piden
        // if ($data['estado'] === 'D') {
        //     return response()->json([
        //         'mensaje' => 'devolver',
        //         'id'      => '2',
        //     ], 400);
        // }

        // En cualquier otro caso, 200 OK con el payload
        return response()->json([
            'success' => true,
            'payload' => $data,
        ], 200);
    }

    public function webhookAbono(Request $request)
    {
        try {
            // 0) Si el conceptoPago es "devolucion", devolvemos inmediatamente 400
            if (strtolower($request->input('conceptoPago','')) === 'devolucion') {
                return response()->json([
                    'mensaje' => 'devolver',
                    'id'      => '2',
                ], 400);
            }
            // 1) Validar los campos
            $validator = Validator::make($request->all(), [
                'id'                      => 'required|integer',
                'fechaOperacion'          => 'required|digits:8',
                'institucionOrdenante'    => 'required|digits:5',
                'institucionBeneficiaria' => 'required|digits:5',
                'claveRastreo'            => 'required|string|max:30',
                'monto'                   => 'required|numeric',
                'nombreOrdenante'         => 'nullable|string|max:120',
                'tipoCuentaOrdenante'     => 'nullable|digits:2',
                'cuentaOrdenante'         => 'nullable|string|max:20',
                'rfcCurpOrdenante'        => 'nullable|string|max:18',
                'nombreBeneficiario'      => 'required|string|max:40',
                'tipoCuentaBeneficiario'  => 'required|digits:2',
                'cuentaBeneficiario'      => 'required|string|max:20',
                'nombreBeneficiario2'     => 'nullable|string|max:40',
                'tipoCuentaBeneficiario2' => 'nullable',
                'cuentaBeneficiario2'     => 'nullable|string|max:18',
                'rfcCurpBeneficiario'     => 'required|string|max:18',
                'conceptoPago'            => 'required|string|max:40',
                'referenciaNumerica'      => 'required|digits_between:1,7',
                'empresa'                 => 'required|string|max:15',
                'tipoPago'                => 'required|digits_between:1,2',
                'tsLiquidacion'           => 'required|digits:13',
                'folioCodi'               => 'nullable|string|max:20',
            ]);

            if ($validator->fails()) {
                // Si hay errores de validación, devolvemos también el "devolver"
                return response()->json([
                    'mensaje' => 'devolver',
                    'id'      => $request->input('id'),
                    'errores' => $validator->errors()->toArray(), // opcional, solo para pruebas
                ], 400);
            }

            // 2) Obtener datos validados
            $data = $validator->validated();

            // 3) Procesar el abono
            Log::info('STP SendAbono recibido:', $data);

            // 4) Responder rápido con 200 OK
            return response()->json([
                'success' => true,
                'payload' => $data,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error en webhookAbono: '.$e->getMessage());
            return response()->json([
                'mensaje' => 'devolver',
                'id'      => $request->input('id'),
            ], 400);
        }
    }
     public function showRetornaForm()
    {
        return view('stp.retorna_form');
    }

    /** Procesar el retorno */
    public function retornaOrden(Request $r)
    {
        // 1) validación
        $f = $r->validate([
            'fechaOperacion'                => 'required|digits:8',
            'institucionOperante'           => 'required|digits:5',
            'claveRastreo'                  => 'required|string|max:30',
            'claveRastreoDevolucion'        => 'required|string|max:30|different:claveRastreo',
            'empresa'                       => 'required|string|max:15',
            'monto'                         => 'required|numeric',
            'digitoIdentificadorBeneficiario'=> 'required|digits:1',
            'medioEntrega'                  => 'required|digits:1',
        ]);

        // 2) montar la cadena original:
        //    ||fechaOperacion|institucionOperante|claveRastreo|monto|digitoIdentificadorBeneficiario|claveRastreoDevolucion|medioEntrega||
        $parts = [
            $f['fechaOperacion'],
            $f['institucionOperante'],
            $f['claveRastreo'],
            number_format($f['monto'],2,'.',''),
            $f['digitoIdentificadorBeneficiario'],
            $f['claveRastreoDevolucion'],
            $f['medioEntrega'],
        ];
        $cadena = '||'.implode('|', $parts).'||';

        // 3) firmar
        $pem  = file_get_contents(public_path('stp_leys/inmas.pem'));
        $pkey = openssl_pkey_get_private($pem, 'X}Zl0/RtjuI(=Esz3+Vq');
        openssl_sign($cadena, $bin, $pkey, OPENSSL_ALGO_SHA256);
        $firma = base64_encode($bin);

        // 4) payload y llamada PUT
        $payload = array_merge($f, ['firma' => $firma]);

        $resp = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->put(
                'https://demo.stpmex.com:7024/speiws/rest/ordenPago/retornaOrden',
                $payload
            );

        // 5) regresar a la vista con todos los datos para debug
        return view('stp.retorna_form', compact('f','cadena','firma','payload','resp'));
    }

}
