<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RentalRequestReceived;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RentController extends Controller
{
    public function rent(Request $request, $carId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to rent a car.');
        }

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

        if ($endDate <= $startDate->add(new DateInterval('PT24H'))) {
            return back()->with('error', 'The rental period must be at least 24 hours.');
        }

        $duration = $startDate->diff($endDate);
        $hours = $duration->h + ($duration->days * 24);
        $totalPrice = $hours * $car->price_per_hour;

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

        Log::info('Rental created:', $rental->toArray());

        // Notificación admin
        $admins = User::where('is_admin', true)->get();
        Log::info('Admins retrieved:', $admins->toArray());
        Notification::send($admins, new RentalRequestReceived($rental));
        Log::info('Notification sent to admins.');

        return back()->with('success', 'Rental request sent successfully, waiting for approval.');
    }
}
