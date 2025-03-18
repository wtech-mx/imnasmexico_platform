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
        Log::info('📩 Webhook recibido:', $request->all());

        $data = $request->all();

        // Verificar si el webhook tiene mensajes de WhatsApp
        if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
            foreach ($data['entry'][0]['changes'][0]['value']['messages'] as $message) {
                $phoneNumber = $message['from']; // Número del remitente
                $text = $message['text']['body'] ?? null; // Contenido del mensaje
                $timestamp = $message['timestamp'] ?? now()->timestamp;
                $messageId = $message['id'];

                if ($text) {
                    // Buscar o crear la conversación
                    $chat = Chat::firstOrCreate([
                        'client_phone' => $phoneNumber
                    ]);

                    // Guardar el mensaje en la base de datos
                    Message::create([
                        'chat_id' => $chat->id,
                        'message_id' => $messageId,
                        'content' => $text,
                        'direction' => 'toApp', // Indica que es un mensaje entrante
                        'timestamp' => $timestamp
                    ]);

                    Log::info("📥 Mensaje guardado en la BD: {$text}");
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
