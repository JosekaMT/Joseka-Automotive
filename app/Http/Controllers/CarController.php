<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{

    public function create()
    {
        $car = new Car();
        return view('car.create', compact('car'));
    }

    public function index()
    {
        $cars = Car::paginate(10);
        return view('car.index', compact('cars'));
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
}
