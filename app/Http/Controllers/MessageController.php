<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getMessages(Request $request)
    {
        $chat_id = $request->query('chat_id');

        if (!$chat_id) {
            return response()->json(['error' => 'Chat ID is required'], 400);
        }

        $messages = Message::where('chat_id', $chat_id)->get();

        return response()->json(['data' => $messages], 200);
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'waba_phone_id' => 'required|string',
            'to' => 'required|string',
            'message' => 'required|array',
        ]);

        // Lógica para enviar el mensaje a través de la API de WhatsApp

        // Guardar el mensaje en la base de datos
        $message = new Message();
        $message->chat_id = $request->input('chat_id');
        $message->body = json_encode($request->input('message'));
        $message->type = $request->input('message.type');
        $message->direction = 'toApp';
        $message->sended_by = 'app';
        $message->timestamp = now();
        $message->save();

        return response()->json(['data' => $message], 200);
    }
}
