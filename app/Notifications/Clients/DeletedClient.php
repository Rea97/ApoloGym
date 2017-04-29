<?php

namespace App\Notifications\Clients;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeletedClient extends Notification
{
    use Queueable;

    private $client;

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
                    ->subject('Registro de cliente eliminado')
                    ->line('Se ha eliminado el registro de un cliente.')
                    ->action('ver lista de clientes', route('dashboard.clients'))
                    ->line("{$this->client->name} {$this->client->first_surname} ya no forma parte de nuestros clientes.")
                    ->line("Puedes comunicarte con él a través de su email: {$this->client->email}");

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
            'icon' => 'fa-user-times',
            'message' => "Se ha eliminado al cliente #{$this->client->id}",
            'action' => route('dashboard.clients')
        ];
    }
}
