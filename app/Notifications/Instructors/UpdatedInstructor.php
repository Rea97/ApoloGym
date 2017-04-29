<?php

namespace App\Notifications\Instructors;

use App\Models\Instructor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdatedInstructor extends Notification
{
    use Queueable;

    private $instructor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
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
            ->subject('Registro de instructor actualizado')
            ->line("Se ha actualizado la información del instructor #{$this->instructor->id}.")
            ->action('Ver instructor', route('dashboard.admin.instructor', [$this->instructor->id]));
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
            'icon' => 'fa-refresh',
            'message' => "Se ha actualizado al instructor {$this->instructor->id}.",
            'action' => route('dashboard.admin.instructor', [$this->instructor->id])
        ];
    }
}
