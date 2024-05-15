<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
RentalRequestStatusChanged.PHP:<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalRequestStatusChanged extends Notification
{
    use Queueable;

    protected $rental;
    protected $status;
    protected $message;

    public function __construct($rental, $status, $message)
    {
        $this->rental = $rental;
        $this->status = $status;
        $this->message = $message;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->message)
            ->action('View Details', url('/'))
            ->line('Thank you for using our application!');
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'rental_id' => $this->rental->id,
            'status' => $this->status,
            'message' => $this->message,
            'brand' => $this->rental->car->brand,
            'model' => $this->rental->car->model,
            'start_date' => $this->rental->start_date,
            'end_date' => $this->rental->end_date,
            'total_price' => $this->rental->total_price,
            'action_url' => url('/rentals/' . $this->rental->id),
        ];
    }
}