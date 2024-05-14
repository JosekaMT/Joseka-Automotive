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
    protected $status;
    protected $adminResponse;

    public function __construct($rental, $status = 'pending', $adminResponse = null)
    {
        $this->rental = $rental;
        $this->status = $status;
        $this->adminResponse = $adminResponse;
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->line('A rental application has been received.')
            ->action('View Details', url('/'))
            ->line('Thank you for using our application!');

        if ($this->status != 'pending') {
            $mailMessage->line("The rental application has been {$this->status}.");
        }

        return $mailMessage;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        $data = [
            'rental_id' => $this->rental->id,
            'message' => 'A rental application has been received.',
            'brand' => $this->rental->car->brand,
            'model' => $this->rental->car->model,
            'start_date' => $this->rental->start_date,
            'end_date' => $this->rental->end_date,
            'total_price' => $this->rental->total_price,
            'action_url' => url('/rentals/' . $this->rental->id),
            'user_name' => $this->rental->user->name, // Agregar el nombre del usuario
        ];

        if ($this->status != 'pending') {
            $data['message'] = "The rental application has been {$this->status}.";
            $data['adminResponse'] = $this->adminResponse;
        }

        return $data;
    }
}
