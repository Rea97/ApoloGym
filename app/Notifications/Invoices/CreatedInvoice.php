<?php

namespace App\Notifications\Invoices;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use phpDocumentor\Reflection\Types\Boolean;

class CreatedInvoice extends Notification
{
    use Queueable;

    private $invoice;

    private $isForClient;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice, $isForClient = false)
    {
        $this->invoice = $invoice;
        $this->isForClient = $isForClient;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->isForClient) {
            return ['database', 'mail'];
        }
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
        if ($this->isForClient) {
            return (new MailMessage)
                ->subject('Factura nueva')
                ->line('Se ha generado una nueva factura a tú nombre.')
                ->action('Ver Factura', route('dashboard.invoice.pdf', [$this->invoice->id]))
                ->line('¡Gracias por ser nuestro cliente!');
        }
        return (new MailMessage)
            ->subject('Factura nueva')
            ->line("Se ha generado una nueva factura con ID #{$this->invoice->id}.")
            ->action('Ver Factura', route('dashboard.invoice', [$this->invoice->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($this->isForClient) {
            return [
                'icon' => 'fa-file-text-o',
                'message' => "Tienes una nueva factura pendiente.",
                'action' => route('dashboard.invoice.pdf', [$this->invoice->id])
            ];
        }
        return [
            'icon' => 'fa-file-text-o',
            'message' => "Se ha creado una factura, #{$this->invoice->id}.",
            'action' => route('dashboard.invoice', [$this->invoice->id])
        ];
    }
}
