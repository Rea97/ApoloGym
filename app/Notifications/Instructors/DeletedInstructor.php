<?php

namespace App\Notifications\Instructors;

use App\Models\Instructor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeletedInstructor extends Notification
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
                    ->subject('Instructor eliminado')
                    ->line("Se ha eliminado a {$this->instructor->name} {$this->instructor->first_surname} como instructor.")
                    ->line("Aún puedes ponerte en contácto mandandole un email a {$this->instructor->email}")
                    ->action('Ver instructores', route('dashboard.instructors'));
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
            'message' => "Instructor #{$this->instructor->id} eliminado.",
            'action' => route('dashboard.instructors')
        ];
    }
}
