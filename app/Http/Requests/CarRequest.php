<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'body' => 'required|string|in:Convertible,Coupe,Ranchera,Hatchback,Berlina,SUV,MPV,Pickup',
            'fuel' => 'required|string|in:Petrol,Diesel',
            'gears' => 'required|string|in:Manual,Automatic',
            'engine' => 'required|numeric',
            'horsepower' => 'required|numeric',
            'seats' => 'required|numeric|min:1',
            'color' => 'required|string|in:Red,Blue,Green,Yellow,Black,White,Silver',
            'price_per_hour' => 'required|numeric',
            'available' => 'required|boolean',
            'rented' => 'required|boolean',
            'description' => 'required|string|max:255'
        ];
    }
}
