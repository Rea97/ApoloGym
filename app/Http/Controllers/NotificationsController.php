<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Notifications\Notification;

class NotificationsController extends Controller
{
    private $request;
    private $response;

    public function __construct(Request $request, ResponseFactory $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        if ($this->request->ajax()) {
            return $this->response->json([
                'notifications' => $this->request->user()->notifications
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function unread()
    {
        if ($this->request->ajax()) {
            $notifications = $this->request->get('data') == 'count' ?
                $this->request->user()->unreadNotifications->count() :
                $this->request->user()->unreadNotifications;
            return $this->response->json([
                'notifications' => $notifications
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function all()
    {
        if ($this->request->ajax()) {
            $notifications = $this->request->user()->notifications;
            return $this->response->json([
                'notifications' => $notifications
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function markAsRead($id)
    {
        $notification = $this->request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return $this->response->json([
            'message' => [
                'type' => 'success',
                'content' => 'Notificación leída.'
            ]
        ]);
    }

    public function deleteAll()
    {
        $this->request->user()->notifications()->delete();
        return $this->response->json(['message' => 'Se han eliminado las notificaciones.']);
    }
}
