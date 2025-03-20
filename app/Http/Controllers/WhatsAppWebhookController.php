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
        $data = json_encode($request->all(), JSON_PRETTY_PRINT);

        // ✅ 1. Guardar en storage/logs/webhook_log.txt
        try {
            $logFile = storage_path('logs/webhook_log.txt');
            file_put_contents($logFile, now() . " - Webhook recibido:\n" . $data . "\n\n", FILE_APPEND);
        } catch (\Exception $e) {
            Log::error("❌ Error escribiendo en storage/logs/webhook_log.txt: " . $e->getMessage());
        }

        // ✅ 2. Guardar en public/webhook_log.txt (para verlo desde el navegador)
        try {
            $publicLogFile = public_path('webhook_log.txt');
            file_put_contents($publicLogFile, now() . " - Webhook recibido:\n" . $data . "\n\n", FILE_APPEND);
        } catch (\Exception $e) {
            Log::error("❌ Error escribiendo en public/webhook_log.txt: " . $e->getMessage());
        }

        // ✅ 3. Guardar en el Log de Laravel
        Log::info("📩 Webhook recibido:", $request->all());

        // ✅ 4. Responder con los datos del webhook para verificar que llega
        return response()->json([
            'status' => 'Webhook recibido!',
            'data' => $request->all()
        ], 200);
    }




}
