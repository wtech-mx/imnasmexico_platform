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
        $logFile = storage_path('logs/webhook_log.txt'); // Archivo para registrar los webhooks
        file_put_contents($logFile, json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

        $data = $request->all();

        if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
            foreach ($data['entry'][0]['changes'][0]['value']['messages'] as $message) {
                $phoneNumber = $message['from'] ?? null;
                $text = $message['text']['body'] ?? null;
                $timestamp = $message['timestamp'] ?? now()->timestamp;
                $messageId = $message['id'] ?? null;

                if (!$phoneNumber || !$text || !$messageId) {
                    file_put_contents($logFile, "❌ Falta información en el mensaje\n", FILE_APPEND);
                    continue;
                }

                // 📌 Buscar o crear el chat
                $chat = Chat::firstOrCreate(['client_phone' => $phoneNumber]);

                // 📌 Guardar mensaje en la base de datos
                $msg = Message::create([
                    'chat_id' => $chat->id,
                    'message_id' => $messageId,
                    'body' => $text,
                    'direction' => 'toApp',
                    'timestamp' => $timestamp
                ]);

                file_put_contents($logFile, "✅ Mensaje guardado en la BD: " . json_encode($msg->toArray()) . "\n", FILE_APPEND);
            }
        }

        return response()->json(['status' => 'success']);
    }


}
