<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RentalRequestReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CarController extends Controller
{

    public function create()
    {
        $car = new Car();
        return view('car.create', compact('car'));
    }

    public function index()
    {
        $cars = Car::all();
        $totalCars = Car::count();
        $availableCars = Car::where('available', true)->count();
        $totalUsers = User::where('is_admin', false)->count();

        return view('car.index', compact('cars', 'totalCars', 'availableCars', 'totalUsers'));
    }

    public function showCars()
    {
        $cars = Car::where('available', true)->get(); // Obtener solo los coches disponibles cliente
        return view('vehicles', compact('cars'));
    }



    public function store(CarRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Procesar y guardar las imágenes
        $imagePaths = [];
        foreach (['image1', 'image2', 'image3'] as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $image = $request->file($imageKey);
                $path = $image->store('car_images', 'public');
                $imagePaths[$imageKey] = $path;
            }
        }

        // Guardar el coche con las rutas de las imágenes
        $car = new Car($validatedData);
        $car->image1 = $imagePaths['image1'] ?? null;
        $car->image2 = $imagePaths['image2'] ?? null;
        $car->image3 = $imagePaths['image3'] ?? null;
        $car->save();

        return Redirect::route('cars.index')
            ->with('success', 'Vehicle created successfully.');
    }

    public function show($id): View
    {
        $car = Car::find($id);
        return view('car.show', compact('car'));
    }

    public function edit($id): View
    {
        $car = Car::find($id);
        return view('car.edit', compact('car'));
    }

    public function update(CarRequest $request, $id): RedirectResponse
    {
        $car = Car::find($id);
        $validatedData = $request->validated();

        // Procesar y guardar las imágenes
        $imagePaths = [];
        foreach (['image1', 'image2', 'image3'] as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $image = $request->file($imageKey);
                $path = $image->store('car_images', 'public');
                $imagePaths[$imageKey] = $path;
            }
        }

        // Actualizar el coche con las nuevas rutas de las imágenes
        $car->fill($validatedData);
        $car->image1 = $imagePaths['image1'] ?? $car->image1;
        $car->image2 = $imagePaths['image2'] ?? $car->image2;
        $car->image3 = $imagePaths['image3'] ?? $car->image3;
        $car->save();

        return Redirect::route('cars.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        \Log::info("Attempting to delete vehicle with ID: $id"); // Esto agregará una entrada en tus logs.
        $car = Car::find($id);
        if ($car) {
            $car->delete();
            \Log::info("Vehicle deleted successfully.");
            return Redirect::route('cars.index')->with('success', 'Vehicle deleted successfully.');
        } else {
            \Log::error("Vehicle not found.");
            return Redirect::route('cars.index')->with('error', 'Vehicle not found.');
        }
    }

    public function rentVehicle($id): View
    {
        $car = Car::findOrFail($id);
        return view('rent-vehicles', compact('car', 'id')); // Pasar el ID del vehículo a la vista
    }


    public function rent(Request $request, $carId)
    {
        $validator = Validator::make($request->all(), [
            'pickup_date_time' => 'required|date',
            'dropoff_date_time' => 'required|date|after:pickup_date_time'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $car = Car::findOrFail($carId);
        $startDate = new \DateTime($request->pickup_date_time);
        $endDate = new \DateTime($request->dropoff_date_time);

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

        $admins = User::where('is_admin', true)->get();
        Notification::send($admins, new RentalRequestReceived($rental));

        return back()->with('message', 'Rental request sent successfully, waiting for approval.');
    }
}
