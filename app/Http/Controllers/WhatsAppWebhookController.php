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
    public function webhook(){
        //TOQUEN QUE QUERRAMOS PONER
        $token = '7207405455';
        //RETO QUE RECIBIREMOS DE FACEBOOK
        $hub_challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';
        //TOQUEN DE VERIFICACION QUE RECIBIREMOS DE FACEBOOK
        $hub_verify_token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
        //SI EL TOKEN QUE GENERAMOS ES EL MISMO QUE NOS ENVIA FACEBOOK RETORNAMOS EL RETO PARA VALIDAR QUE SOMOS NOSOTROS
        if ($token === $hub_verify_token) {
            echo $hub_challenge;
            exit;
        }
    }

    /*
    * RECEPCION DE MENSAJES
    */
    public function recibe(Request $request)
    {
        try {
            // 1️⃣ Capturar el JSON completo del Webhook
            $data = $request->all();

            // 2️⃣ Registrar en el Log de Laravel
            Log::info('📩 Webhook recibido:', $data);

            // 3️⃣ Guardar en un archivo de texto en public/
            File::put(public_path('webhook_log.txt'), json_encode($data, JSON_PRETTY_PRINT));

            // 4️⃣ Verificar si el webhook tiene mensajes de WhatsApp
            if (!isset($data['entry'][0]['changes'][0]['value']['messages'])) {
                return response()->json(['status' => 'no_messages_received']);
            }

            // 5️⃣ Extraer el mensaje recibido
            $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
            $phoneNumber = $this->formatPhoneNumber($message['from']);
            $text = $message['text']['body'] ?? null;
            $timestamp = $message['timestamp'] ?? now()->timestamp;
            $messageId = $message['id'];

            // 6️⃣ Guardar en la Base de Datos solo si hay texto
            if ($text) {
                $chat = Chat::firstOrCreate([
                    'client_phone' => $phoneNumber
                ]);

                $messageData = [
                    'chat_id' => $chat->id,
                    'timestamp' => $timestamp,
                    'message_id' => $messageId,
                    'type' => 'text',
                    'direction' => 'toApp',
                    'body' => json_encode(['type' => 'text', 'text' => ['preview_url' => false, 'body' => $text]]),
                    'status' => 10
                ];

                Log::info("📥 Datos del mensaje a guardar en la BD:", $messageData);

                Message::create($messageData);

                Log::info("📥 Mensaje guardado en la BD: {$text}");
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error("❌ Error en el webhook: " . $e->getMessage());
            File::put(public_path('webhook_error.txt'), $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Formatear el número de teléfono eliminando el '1' después del '55'
     */
    private function formatPhoneNumber($phoneNumber)
    {
        if (substr($phoneNumber, 0, 3) === '521') {
            return '52' . substr($phoneNumber, 3);
        }
        return $phoneNumber;
    }
}
