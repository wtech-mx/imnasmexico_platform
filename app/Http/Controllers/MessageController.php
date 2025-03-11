<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('ajax.messages', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'chat_id' => 'required|exists:chats,id',
        ]);

        $message = new Message();
        $message->content = $request->content;
        $message->chat_id = $request->chat_id;
        $message->save();

        return response()->json($message);
    }

    public function getMessages(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
        ]);

        $messages = Message::where('chat_id', $request->chat_id)->get();
        return response()->json($messages);
    }
}
