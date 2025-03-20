<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use App\Models\Message;

class WhatsAppWebhookController extends Controller
{
    /**
     * ✅ Verificar el Webhook con Facebook (GET)
     */
    public function verifyWebhook(Request $request)
    {
        $verifyToken = '7207405455';

        if ($request->hub_mode === 'subscribe' && $request->hub_verify_token === $verifyToken) {
            return response($request->hub_challenge, 200);
        }

        return response('Error de verificación', 403);
    }

    /**
     * ✅ Manejar los mensajes entrantes (POST)
     */
    public function handleWebhook(Request $request)
    {
        // 📌 Guardar el webhook en un archivo de texto en `public/` para que sea accesible desde el navegador
        $logFile = public_path('webhook_log.txt');
        file_put_contents($logFile, json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

        return response()->json(['status' => 'success']);
    }



}
