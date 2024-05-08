<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalRequestReceived extends Notification
{
    use Queueable;

    protected $rental;

    public function __construct($rental)
    {
        $this->rental = $rental;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Una nueva solicitud de alquiler ha sido recibida.')
            ->action('Ver Detalles', url('/'))
            ->line('Gracias por usar nuestra aplicación!');
    }
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'rental_id' => $this->rental->id,
            'message' => 'Una nueva solicitud de alquiler ha sido recibida.',
            'action_url' => url('/rentals/' . $this->rental->id),
        ];
    }
}
