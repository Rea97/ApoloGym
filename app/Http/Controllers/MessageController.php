<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;

class MessageController extends Controller
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function showChatWithClient(Request $request, Client $client)
    {
        $messagesSentByUser = $request->user()->messages()
            ->where('recipient_id', '=', $client->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messagesSentByClient = $client->messages()
            ->where('recipient_id', '=', $request->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messages = Collection::make([$messagesSentByUser, $messagesSentByClient])->collapse();
        $orderedMessages = $messages->sortBy('created_at');
        return view('sections.chat', compact('orderedMessages', 'client'));
    }

    public function messageToClient(Request $request, Client $client)
    {
        $success = $this->messageTo($client, $request);
        if (! $success) {
            return redirect()->route('dashboard.chatWithClient', [$client->id])->with('error', 'Ha ocurrido un error al enviar tú mensaje.');
        }
        return redirect()->route('dashboard.chatWithClient', [$client->id]);
    }

    public function messageTo($user, Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string'
        ]);
        return Message::create([
            'sender_id' => currentAuth()->id,
            'recipient_id' => $user->id,
            'content' => $request->input('content', 'Error al procesar mensaje.')
        ]);
    }
}
