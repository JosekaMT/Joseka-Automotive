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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car = new Car();
        return view('car.create', compact('car'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::paginate(10); 
        return view('car.index', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            ->with('success', 'Car created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $car = Car::find($id);
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $car = Car::find($id);
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        \Log::info("Attempting to delete car with ID: $id"); // Esto agregará una entrada en tus logs.
        $car = Car::find($id);
        if ($car) {
            $car->delete();
            \Log::info("Car deleted successfully.");
            return Redirect::route('cars.index')->with('success', 'Car deleted successfully.');
        } else {
            \Log::error("Car not found.");
            return Redirect::route('cars.index')->with('error', 'Car not found.');
        }
    }
}
