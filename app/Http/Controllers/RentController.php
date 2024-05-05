<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RentalRequestReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Handle a rental request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $carId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rent(Request $request, $carId)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'pickup_date_time' => 'required|date',
            'dropoff_date_time' => 'required|date|after_or_equal:pickup_date_time'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $car = Car::findOrFail($carId);
        $startDate = new DateTime($request->input('pickup_date_time'));
        $endDate = new DateTime($request->input('dropoff_date_time'));

        // Ensure at least 24 hours of rental period
        if ($endDate <= $startDate->add(new DateInterval('PT24H'))) {
            return back()->with('error', 'The rental period must be at least 24 hours.');
        }

        // Calculate the duration in hours
        $duration = $startDate->diff($endDate);
        $hours = $duration->h + ($duration->days * 24);
        $totalPrice = $hours * $car->price_per_hour;

        // Create the rental record
        $rental = new Rental([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->format('Y-m-d H:i:s'),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'brand' => $car->brand,
            'model' => $car->model,
            'image1' => $car->image1
        ]);

        $rental->save();

        // Update car status if necessary
        $car->status = 'rented';
        $car->save();

        // Notify administrators
        $admins = User::where('is_admin', true)->get();
        Notification::send($admins, new RentalRequestReceived($rental));

        return back()->with('message', 'Rental request sent successfully, waiting for approval.');
    }

    class RentalRequestReceived extends Notification
    {
        use Queueable;
    
        public function __construct()
        {
            // Inicialización si es necesario
        }
    
        public function via($notifiable)
        {
            return ['mail']; // Ajusta los canales como necesites
        }
    
        public function toMail($notifiable)
        {
            return (new MailMessage)
                        ->line('The introduction to the notification.')
                        ->action('Notification Action', url('/'))
                        ->line('Thank you for using our application!');
        }
    









    
}