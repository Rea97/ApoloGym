<?php

namespace App\Notifications\Messages;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageForInstructor extends Notification
{
    private $sender;

    private $chatRoute;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender)
    {
        $this->sender = $sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->notificationsVia;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $message = get_class($this->sender) === 'App\Models\Administrator'?
            'Nuevo mensaje proveniente de un administrador.' :
            'Uno de tús clientes te envió un mensaje.';

        $action = get_class($this->sender) === 'App\Models\Administrator' ?
            route('dashboard.chatWithAdmin', [$this->sender->id]) :
            route('dashboard.chatWithClient', [$this->sender->id]);
        return [
            'icon' => 'fa-comment',
            'message' => $message,
            'action' => $action
        ];
    }
}
