<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalRequestReceived extends Notification implements ShouldQueue
{
    use Queueable;

    protected $rental;

    public function __construct($rental)
    {
        $this->rental = $rental;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A rental application has been received.')
            ->action('View Details', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'rental_id' => $this->rental->id,
            'user_id' => $this->rental->user_id,
            'car_id' => $this->rental->car_id,
            'message' => 'A rental application has been received.',
            'brand' => $this->rental->brand,
            'model' => $this->rental->model,
            'start_date' => $this->rental->start_date,
            'end_date' => $this->rental->end_date,
            'total_price' => $this->rental->total_price,
        ];
    }
}
