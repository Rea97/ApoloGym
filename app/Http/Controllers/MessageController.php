<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Client;
use App\Models\Instructor;
use App\Models\Message;
use App\Notifications\Messages\NewMessage;
use App\Notifications\Messages\NewMessageForAdmin;
use App\Notifications\Messages\NewMessageForClient;
use App\Notifications\Messages\NewMessageForInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Notification;

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

        $recipient = $client;
        $recipientTypeArr = explode('\\', get_class($client));
        $recipientType = $recipientTypeArr[count($recipientTypeArr)-1];
        return view('sections.chat', compact('orderedMessages', 'recipient', 'recipientType'));
        //return view('sections.chat', compact('orderedMessages', 'client'));
    }

    public function showChatWithInstructor(Request $request, Instructor $instructor)
    {
        $messagesSentByUser = $request->user()->messages()
            ->where('recipient_id', '=', $instructor->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messagesSentByInstructor = $instructor->messages()
            ->where('recipient_id', '=', $request->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messages = Collection::make([$messagesSentByUser, $messagesSentByInstructor])->collapse();
        $orderedMessages = $messages->sortBy('created_at');

        $recipient = $instructor;
        $recipientTypeArr = explode('\\', get_class($instructor));
        $recipientType = $recipientTypeArr[count($recipientTypeArr)-1];
        return view('sections.chat', compact('orderedMessages', 'recipient', 'recipientType'));

        //return view('sections.chatToInstructor', compact('orderedMessages', 'instructor'));
    }

    public function showChatWithAdmin(Request $request, Administrator $administrator)
    {
        $messagesSentByUser = $request->user()->messages()
            ->where('recipient_id', '=', $administrator->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messagesSentByAdministrator = $administrator->messages()
            ->where('recipient_id', '=', $request->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messages = Collection::make([$messagesSentByUser, $messagesSentByAdministrator])->collapse();
        $orderedMessages = $messages->sortBy('created_at');
        $recipient = $administrator;
        $recipientTypeArr = explode('\\', get_class($administrator));
        $recipientType = $recipientTypeArr[count($recipientTypeArr)-1];
        return view('sections.chatToInstructor', compact('orderedMessages', 'recipient', 'recipientType'));
    }

    public function messageToClient(Request $request, Client $client)
    {
        $success = $this->messageTo($client, $request);
        if (! $success) {
            return redirect()->route('dashboard.chatWithClient', [$client->id])
                ->with('error', 'Ha ocurrido un error al enviar tú mensaje.');
        }
        Notification::send($client, new NewMessageForClient(currentAuth()));
        return redirect()->route('dashboard.chatWithClient', [$client->id]);
    }

    public function messageToInstructor(Request $request, Instructor $instructor)
    {
        $success = $this->messageTo($instructor, $request);
        if ($success) {
            Notification::send($instructor, new NewMessageForInstructor(currentAuth()));
        }
        if (isAdmin()) {
            if (! $success) {
                return redirect()->route('dashboard.chatWithInstructor', [$instructor->id])
                    ->with('error', 'Ha ocurrido un error al enviar tú mensaje.');
            }
            return redirect()->route('dashboard.chatWithInstructor', [$instructor->id]);
        } else if(isClient()) {
            if (! $success) {
                return redirect()->route('dashboard.instructor')
                    ->with('error', 'Ha ocurrido un error al enviar tú mensaje.');
            }
            return redirect()->route('dashboard.instructor');
        }
        return redirect()->route('dashboard.start');

    }

    public function messageToAdministrator(Request $request, Administrator $administrator)
    {
        $success = $this->messageTo($administrator, $request);
        if ($success) {
            Notification::send($administrator, new NewMessageForAdmin(currentAuth()));
        }
        if (! $success) {
            return redirect()->route('dashboard.chatWithAdmin', [$administrator->id])
                ->with('error', 'Ha ocurrido un error al enviar tú mensaje.');
        }
        return redirect()->route('dashboard.chatWithAdmin', [$administrator->id]);
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
