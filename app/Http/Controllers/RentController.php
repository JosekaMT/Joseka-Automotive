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
use Illuminate\Support\Str;

class RentController extends Controller
{
    public function rent(Request $request, $carId)
    {
        // Asegúrate de que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to rent a car.');
        }

        // Validar la solicitud entrante
        $validator = Validator::make($request->all(), [
            'pickup_date_time' => 'required|date',
            'dropoff_date_time' => 'required|date|after_or_equal:pickup_date_time'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obtener los detalles del coche
        $car = Car::findOrFail($carId);
        $startDate = new DateTime($request->input('pickup_date_time'));
        $endDate = new DateTime($request->input('dropoff_date_time'));

        // Asegúrate de que el período de alquiler sea de al menos 24 horas
        if ($endDate <= (clone $startDate)->add(new DateInterval('PT24H'))) {
            return back()->with('error', 'The rental period must be at least 24 hours.');
        }

        // Calcular el precio total
        $duration = $startDate->diff($endDate);
        $hours = $duration->h + ($duration->days * 24);
        $totalPrice = $hours * $car->price_per_hour;

        // Crear el registro de alquiler
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

        // Cargar el usuario asociado al alquiler
        $rental->load('user');

        // Verificar que el usuario está cargado correctamente
        if (!$rental->user) {
            return back()->with('error', 'User not found for the rental.');
        }

        // Encontrar usuarios administradores
        $admins = User::where('is_admin', true)->get();
        if ($admins->isEmpty()) {
            return back()->with('error', 'No administrators found to notify.');
        }

        // Enviar notificación a los administradores
        foreach ($admins as $admin) {
            // Crear la notificación manualmente con un UUID
            $notificationData = [
                'id' => Str::uuid()->toString(), // Genera un UUID
                'type' => RentalRequestReceived::class, // El tipo de notificación que estás usando
                'data' => json_encode([
                    'rental_id' => $rental->id,
                    'user_name' => $rental->user->name, // Incluye el nombre del usuario
                ]),
                'notifiable_id' => $admin->id,
                'notifiable_type' => User::class,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Crear la notificación directamente en la base de datos
            \DB::table('notifications')->insert($notificationData);
        }

        return back()->with('success', 'Rental request sent successfully, waiting for approval.');
    }
}
