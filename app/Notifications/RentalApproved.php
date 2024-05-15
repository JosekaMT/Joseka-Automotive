<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentalApproved extends Notification
{
    use Queueable;

    protected $rental;
    protected $adminName;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Rental  $rental
     * @param  string  $adminName
     * @return void
     */
    public function __construct($rental, $adminName = 'Administration')
    {
        $this->rental = $rental;
        $this->adminName = $adminName;
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
            'car_id' => $this->rental->car_id,
            'car_brand' => $this->rental->car->brand,
            'start_date' => $this->rental->start_date,
            'end_date' => $this->rental->end_date,
            'status' => 'approved',
            'admin_name' => $this->adminName,
        ];
    }
}
