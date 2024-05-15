<?php

namespace App\Notifications;

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentalRequestReceived extends Notification
{
    use Queueable;

    protected $rental;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */

    public function __construct($rental)
    {
        $this->rental = $rental;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'rental_id' => $this->rental->id,
            'user_id' => $this->rental->user_id,
            'user_name' => $this->rental->user->name,
            'car_id' => $this->rental->car_id,
            'car_brand' => $this->rental->car->brand,
            'start_date' => $this->rental->start_date,
            'end_date' => $this->rental->end_date,
            'total_price' => $this->rental->total_price,
            'status' => $this->rental->status,

        ];
    }
}
