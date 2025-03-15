<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    public function showMessenger()
    {
        $conversations = Chat::with('messages')->get();
        $messages = $conversations->first()->messages ?? [];

        return view('whatsapp.messenger', compact('conversations', 'messages'));
    }

    public function showMessenger2()
    {
        $conversations = Chat::with('messages')->get();
        $messages = $conversations->first()->messages ?? [];

        return view('whatsapp.messenger_old', compact('conversations', 'messages'));
    }

    public function showChatBubble()
    {
        return view('whatsapp.chat-bubble');
    }

    public function showSendMediaMessage()
    {
        return view('whatsapp.send-media-message');
    }

    public function sendMediaMessage(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
            'waba_phone_id' => 'required',
            'to' => 'required',
        ]);

        $filePath = $request->file('file')->store('media', 'public');

        return response()->json([
            'status' => 'success',
            'file_path' => Storage::url($filePath),
            'file_type' => $request->file('file')->getMimeType(),
            'waba_phone_id' => $request->waba_phone_id,
            'to' => $request->to,
        ]);
    }

    public function loadMessages($chat_id)
    {
            // Verifica si el chat existe
        $chat = Chat::find($chat_id);
        if (!$chat) {
            return response()->json(['error' => 'Chat no encontrado'], 404);
        }

        // Obtiene los mensajes ordenados por fecha
        $messages = Message::where('chat_id', $chat_id)->orderBy('timestamp', 'asc')->get();

        return response()->json(['data' => $messages]);
    }


    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'waba_phone_id' => 'required',
            'to' => 'required',
            'message.text.body' => 'required|string',
        ]);

        $wabaPhone = WabaPhone::find($validated['waba_phone_id']);
        if (!$wabaPhone) {
            return response()->json(['error' => 'WabaPhone no encontrado'], 404);
        }

        $chat = Chat::where('client_phone', $validated['to'])->first();
        if (!$chat) {
            return response()->json(['error' => 'Chat no encontrado'], 404);
        }

        $message = Message::create([
            'chat_id' => $chat->id,
            'type' => 'text',
            'direction' => 'toApp',
            'body' => json_encode(['text' => $validated['message']['text']['body']]), // Asegúrate de que el valor sea un JSON válido
            'status' => 'sent', // Asegúrate de que el valor sea una cadena de texto
            'timestamp' => now()->timestamp,
        ]);

        // Lógica para enviar el mensaje usando la API de WhatsApp
        $messageService = resolve(MessageService::class);
        $response = $messageService->sendMessage($wabaPhone->phone_id, $validated['to'], [
            'type' => 'text',
            'text' => ['body' => $validated['message']['text']['body']]
        ]);

        if ($response['status'] !== 'success') {
            return response()->json(['error' => 'Error al enviar el mensaje'], 500);
        }

        return response()->json(['message' => 'Mensaje enviado con éxito.', 'data' => $message]);
    }
}
