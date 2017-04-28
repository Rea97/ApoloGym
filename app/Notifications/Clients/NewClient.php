<?php

namespace App\Notifications\Clients;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewClient extends Notification
{
    use Queueable;

    public $client;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'email'];
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
                    ->line('Se ha registrado exitosamente un nuevo cliente en el gimnasio.')
                    ->action('Ver cliente', route('dashboard.client', [$this->client->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Se ha registrado un nuevo cliente en el gimnasio.',
            'action' => url('/dashboard/clientes/'.$this->client->id)
        ];
    }
}
