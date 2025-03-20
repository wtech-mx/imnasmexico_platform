<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Http;

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
        // Log en Laravel
        Log::info('📩 Webhook recibido:', $request->all());

        // Guardar en un archivo para depuración
        File::put(public_path('webhook_log.txt'), json_encode($request->all(), JSON_PRETTY_PRINT));

        $data = $request->all();

        // Verificar si el webhook tiene mensajes de WhatsApp
        if (!isset($data['entry'][0]['changes'][0]['value']['messages'])) {
            return response()->json(['status' => 'no_messages_received']);
        }

        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];

        // Extraer datos importantes
        $phoneNumber = $message['from'];
        $text = $message['text']['body'] ?? null;
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

            // Responder con un mensaje de "Echo"
            $this->sendMessage($phoneNumber, "Echo: " . $text, $messageId);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Enviar un mensaje de respuesta
     */
    private function sendMessage($to, $text, $contextMessageId)
    {
        $businessPhoneNumberId = env('BUSINESS_PHONE_NUMBER_ID');
        $graphApiToken = env('GRAPH_API_TOKEN');

        $response = Http::withToken($graphApiToken)->post("https://graph.facebook.com/v18.0/{$businessPhoneNumberId}/messages", [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'text' => ['body' => $text],
            'context' => ['message_id' => $contextMessageId],
        ]);

        if ($response->successful()) {
            Log::info("📤 Mensaje enviado: {$text}");
        } else {
            Log::error("❌ Error al enviar el mensaje: {$response->body()}");
        }
    }
}
