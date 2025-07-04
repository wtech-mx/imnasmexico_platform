<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
