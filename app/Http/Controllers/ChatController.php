<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function showChatBubble()
    {
        return view('whatsapp.chat-bubble');
    }

    public function showSendMediaMessage()
    {
        return view('whatsapp.send-media-message');
    }

    public function showMessenger()
    {
        return view('whatsapp.messenger');
    }

    public function sendMediaMessage(Request $request)
    {
        $file = $request->file('file');
        $wabaPhoneId = $request->input('waba_phone_id');
        $to = $request->input('to');

        if (!$file || !$wabaPhoneId || !$to) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        // Subir el archivo a un servicio de almacenamiento (por ejemplo, almacenamiento local)
        $filePath = $file->store('media', 'public');

        // Determinar el tipo de archivo
        $fileType = $file->getMimeType();

        // Aquí puedes agregar la lógica para enviar el mensaje multimedia
        // Por ejemplo, puedes usar un servicio de mensajería para enviar el archivo

        // Ejemplo de respuesta simulada
        $response = [
            'status' => 'success',
            'file_path' => Storage::url($filePath),
            'file_type' => $fileType,
            'waba_phone_id' => $wabaPhoneId,
            'to' => $to,
        ];

        return response()->json($response);
    }
}
